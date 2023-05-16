<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fee;
use App\Models\Appointment;
use App\Models\Dokter;
use App\Models\Transaction;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Exception;

// thirdparty package
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function payment($id)
    {
        $appointment = Appointment::where('id', $id)->first();

        $date = $appointment['date'];
        $dokterId = $appointment['dokter_id'];


        $dokter = Dokter::where('id_dokter', $dokterId)->first();

        $dokterFee = $dokter ? $dokter->fee : null;



        $fee = Fee::first();
        $hospital_fee = $fee->fee_rs; // Mengambil nilai fee_rs dari tabel fee
        $doctor_fee = $dokterFee; // Mengambil nilai fee dari tabel dokter
        $grand_total = $hospital_fee + $doctor_fee;


        return view('pages.frontsite.payment.index', compact('dokterFee', 'hospital_fee', 'dokter', 'appointment', 'grand_total', 'id'));
    }

    public function store(Request $request)
    {

        $data = $request->all();

        // set random code for transaction code
        $data['transaction_code'] = Str::upper(Str::random(8) . '-' . date('Ymd'));

        $appointment = Appointment::where('id', $data['appointment_id'])->first();




        $dokterId = $appointment['dokter_id'];


        $dokter = Dokter::where('id_dokter', $dokterId)->first();

        $dokterFee = $dokter ? $dokter->fee : null;


        $fee = Fee::first();
        $hospital_fee = $fee->fee_rs;
        // total

        // total with vat and grand total
        $grand_total = $dokterFee + $hospital_fee;

        // save to database
        $transaction = new Transaksi;
        $transaction->appointment_id = $appointment['id'];
        $transaction->transaction_code = $data['transaction_code'];
        $transaction->fee_doctor = $dokterFee;
        $transaction->fee_hospital = $hospital_fee;


        $transaction->total = $grand_total;
        $transaction->save();

        // midtrans here
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // set all for midtrans
        $midtrans = [
            'transaction_details' => [
                'order_id' => $data['transaction_code'],
                'gross_amount' => $grand_total,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'no_tlp' => Auth::user()->no_tlp,
            ],
            'enabled_payments' => [
                'gopay', 'permata_va', 'bank_transfer'
            ],
            'vtweb' => []
        ];

        // redirect to website midtrans
        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            // Redirect to Snap Payment Page
            // header('Location: ' . $paymentUrl);
            return redirect($paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        // update status appointment
        // $appointment = Appointment::find($appointment->id);
        // $appointment->status = 1; // set to completed payment
        // $appointment->save();

        // return redirect()->route('payment.success');
    }
    public function success()
    {
        return view('pages.frontsite.success.payment-success');
    }
    public function callback()
    {
        // set configuration midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // instance midtrans notification
        $notification = new Notification();

        // Assign ke variable
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        // search transaction by transaction code
        $transaction = Transaksi::findOrFail('transaction_code', $order_id);
        $appointment_id = $transaction->appointment->id;

        // Handle notification status
        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $transaction->status = 'PENDING';
                    $status_appointment = 0;
                } else {
                    $transaction->status = 'SUCCESS';
                    $status_appointment = 1;
                }
            }
        } else if ($status == 'settlement') {
            $transaction->status = 'SUCCESS';
            $status_appointment = 1;
        } else if ($status == 'pending') {
            $transaction->status = 'PENDING';
            $status_appointment = 0;
        } else if ($status == 'deny') {
            $transaction->status = 'CANCELLED';
            $status_appointment = 2;
        } else if ($status == 'expire') {
            $transaction->status = 'CANCELLED';
            $status_appointment = 2;
        } else if ($status == 'cancel') {
            $transaction->status = 'CANCELLED';
            $status_appointment = 2;
        }

        // update status appointment
        $appointment = Appointment::find($appointment_id);
        $appointment->status = $status_appointment; // set to completed payment
        $appointment->save();

        return redirect()->route('payment.success');
    }
}
