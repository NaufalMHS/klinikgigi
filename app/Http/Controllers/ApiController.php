<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Appointment;
use illuminate\Http\Request;

class ApiController extends Controller
{
    public function payment_handler(Request $request)
    {
        $json = json_decode($request->getContent());

        $signature_key = hash('sha512', $json->order_id . $json->status_code . $json->gross_amount . env('MIDTRANS_SERVER_KEY'));

        if ($signature_key != $json->signature_key) {
            return abort(404);
        }

        $transaction = Transaksi::where('transaction_code', $json->order_id)->first();
        $transaction->update(['status' => $json->transaction_status]);

        // Update the appointment status if the transaction exists
        if ($transaction) {
            $appointment = Appointment::where('id', $transaction->appointment_id)->first();
            if ($appointment) {
                $appointment->update(['status' => $json->transaction_status]);
            }
        }

        return $transaction;
    }
}
