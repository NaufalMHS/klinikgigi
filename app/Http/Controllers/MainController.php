<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Tentang;
use App\Models\Dokter;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleXMLElement;

class MainController extends Controller
{
    public function index()
    {
        $galeri = Galeri::get();
        $tentang = Tentang::first();
        $dokter = Dokter::get();
        $pasien = Pasien::get();


        $kategori = Galeri::kategori()->get();
        return view('landing-page.index', [
            'title' => 'Beranda',
            'menu' => 'home',
            'galeri' => $galeri,
            'tentang' => $tentang,
            'dokter' => $dokter,
            'pasien' => $pasien
        ]);
    }

    public function appointment($id)
    {
        $dokter = Dokter::where('id_dokter', decrypt($id))->get();


        $user = Auth::user();
        return view('pages.frontsite.appointment.index', [
            'title' => 'appointment',
            'menu' => 'appointment',
            'dokter' => $dokter,
            'user' => $user
        ]);
    }
}
