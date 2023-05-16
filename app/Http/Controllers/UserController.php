<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Galeri;
use App\Models\Tentang;
use App\Models\User;
use App\Models\Counter;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{



    public function transaksi()
    {


        $userId = Auth::id();
        $transaksi = DB::table('transaction')
            ->join('appointment', 'transaction.appointment_id', '=', 'appointment.id')
            ->join('users', 'appointment.user_id', '=', 'users.id')
            ->where('users.id', $userId)
            ->select('transaction.*')
            ->paginate(10);

        return view('user.transaksi', [
            'title' => 'transaksi Page',
            'menu' => 'transaksi',
            'transaksi' => $transaksi,
        ]);
    }
    public function appointment()
    {
        $userId = Auth::id();
        $appointment = DB::table('appointment')
            ->join('users', 'appointment.user_id', '=', 'users.id')
            ->select('appointment.*', 'users.*')
            ->where('users.id', $userId)
            ->paginate(10);

        return view('user.appointment', [
            'title' => 'appointment Page',
            'menu' => 'appointment',
            'appointment' => $appointment,
        ]);
    }
}
