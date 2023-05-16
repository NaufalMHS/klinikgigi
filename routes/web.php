<?php

use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//index
Route::get('/', [MainController::class, 'index']);
Route::get('/user-area', [UserController::class, 'appointment'])->middleware('auth', 'role:3');
Route::get('/user-area/transaksi', [UserController::class, 'transaksi'])->middleware('auth', 'role:3');
//Admin : Main Page
Route::get('/admin-area', [AdminController::class, 'index'])->middleware('auth', 'role:1');

Route::get('/admin-area/appointment', [AdminController::class, 'appointment'])->middleware('auth', 'role:1');
Route::get('/admin-area/transaksi', [AdminController::class, 'transaksi'])->middleware('auth', 'role:1');
//Admin : pasien Page
Route::get('/admin-area/pasien', [AdminController::class, 'pasien'])->middleware('auth', 'role:1');

//Admin : pasien Page -> Search
Route::post('/admin-area/pasien', [PasienController::class, 'pasien_search'])->middleware('auth', 'role:1');

//Admin : pasien Page -> Edit Form
Route::get('/admin-area/pasien/edit/{id}', [PasienController::class, 'pasien_edit'])->middleware('auth', 'role:1');

//Admin : Pasien -> Edit Page
Route::get('/admin-area/pasien/edit/{id}/{from}', [PasienController::class, 'pasien_edit'])->middleware('auth', 'role:1');

//Admin : Pasien -> Edit Data
Route::post('/admin-area/pasien/edit/update', [PasienController::class, 'pasien_update'])->middleware('auth', 'role:1');

//Admin : pasien Page -> Delete Data
Route::get('/admin-area/pasien/delete/{id}', [PasienController::class, 'pasien_delete'])->middleware('auth', 'role:1');

//Excel
Route::get('export-data', [PasienController::class, 'export'])->name('Pasien.export');

//Admin : Gallery Page
Route::get('/admin-area/galeri', [AdminController::class, 'gallery'])->middleware('auth', 'role:1');

//Admin : Gallery Page -> Search
Route::post('/admin-area/galeri', [GaleriController::class, 'gallery_search'])->middleware('auth', 'role:1');

//Admin : Gallery Page -> New Data
Route::get('admin-area/galeri/new', [AdminController::class, 'gallery_new'])->middleware('auth', 'role:1');

//Admin : Gallery Page -> Submit
Route::post('admin-area/galeri/submit', [GaleriController::class, 'gallery_submit'])->middleware('auth', 'role:1');

//Admin : Gallery Page -> Edit Form
Route::get('/admin-area/galeri/edit/{id}', [GaleriController::class, 'gallery_edit'])->middleware('auth', 'role:1');

//Admin : Gallery Page -> Edit Data
Route::post('/admin-area/galeri/edit/update', [GaleriController::class, 'gallery_update'])->middleware('auth', 'role:1');

//Admin : Gallery Page -> Delete Data
Route::get('/admin-area/galeri/delete/{id}', [GaleriController::class, 'gallery_delete'])->middleware('auth', 'role:1');

//Admin : Category Page
Route::get('/admin-area/kategori-galeri', [AdminController::class, 'kategori'])->middleware('auth', 'role:1');

//Admin : Category Page -> Search
Route::post('/admin-area/kategori-galeri', [GaleriController::class, 'kategori_search'])->middleware('auth', 'role:1');

//Admin : Category Page -> New Data
Route::get('/admin-area/kategori-galeri/new', [AdminController::class, 'kategori_new'])->middleware('auth', 'role:1');

//Admin : Category Page -> Submit
Route::post('/admin-area/kategori-galeri/submit', [GaleriController::class, 'kategori_submit'])->middleware('auth', 'role:1');

//Admin : Category Page -> Details Page
Route::get('/admin-area/kategori-galeri/detail/{id}', [GaleriController::class, 'kategori_details'])->middleware('auth', 'role:1');

//Admin : Category Page -> Edit Page
Route::get('/admin-area/kategori-galeri/edit/{id}', [GaleriController::class, 'kategori_edit'])->middleware('auth', 'role:1');

//Admin : Category Page -> Edit Data
Route::post('/admin-area/kategori-galeri/edit/update', [GaleriController::class, 'kategori_update'])->middleware('auth', 'role:1');

//Admin : Category Page -> Delete Data
Route::get('/admin-area/kategori-galeri/delete/{id}', [GaleriController::class, 'kategori_delete'])->middleware('auth', 'role:1');

//Admin : Information
Route::get('/admin-area/informasi-umum', [AdminController::class, 'about'])->middleware('auth', 'role:1');

//Admin : Information -> Edit Pictures
Route::post('/admin-area/informasi-umum/edit-foto', [TentangController::class, 'photo_edit'])->middleware('auth', 'role:1');

//Admin : Information -> Edit Informasi
Route::post('/admin-area/informasi-umum/edit-deskripsi', [TentangController::class, 'informasi_edit'])->middleware('auth', 'role:1');

//Admin : Information -> Edit Visi
Route::post('/admin-area/informasi-umum/edit-visi', [TentangController::class, 'visi_edit'])->middleware('auth', 'role:1');

//Admin : Information -> Edit Misi
Route::post('/admin-area/informasi-umum/edit-misi', [TentangController::class, 'misi_edit'])->middleware('auth', 'role:1');

//Admin : Account
Route::get('/admin-area/akun', [AdminController::class, 'account'])->middleware('auth', 'role:1');

//Admin : Account -> Search
Route::post('/admin-area/akun', [AkunController::class, 'account_search'])->middleware('auth', 'role:1');

//Admin : Account -> Details
Route::get('/admin-area/akun/detail', [AkunController::class, 'account_detail'])->middleware('auth', 'role:1');

//Admin : Account -> New Data
Route::get('/admin-area/akun/new', [AdminController::class, 'account_new'])->middleware('auth', 'role:1');

//Admin : Account -> Submit
Route::post('/admin-area/akun/submit', [AkunController::class, 'account_submit'])->middleware('auth', 'role:1');
Route::post('/user-area/akun/submit', [AkunController::class, 'account_submit_user'])->middleware('guest');

//Admin : Account -> Edit Page
Route::get('/admin-area/akun/edit/{id}/{from}', [AkunController::class, 'account_edit'])->middleware('auth', 'role:1');

//Admin : Account -> Edit Data
Route::post('/admin-area/akun/edit/update', [AkunController::class, 'account_update'])->middleware('auth', 'role:1');

//Admin : Account -> Delete Data
Route::get('/admin-area/akun/delete/{id}/{from}', [AkunController::class, 'account_delete'])->middleware('auth', 'role:1');

//Admin : Dokter
Route::get('/admin-area/dokter', [AdminController::class, 'dokter'])->middleware('auth', 'role:1');

//Admin : dokter -> Search
Route::post('/admin-area/dokter', [DokterController::class, 'dokter_search'])->middleware('auth', 'role:1');

//Admin : dokter -> New Form
Route::get('/admin-area/dokter/new', [AdminController::class, 'dokter_new'])->middleware('auth', 'role:1');

//Admin : dokter -> Submit
Route::post('/admin-area/dokter/submit', [DokterController::class, 'dokter_submit'])->middleware('auth', 'role:1');

//Admin : dokter -> Edit Form
Route::get('/admin-area/dokter/edit/{id}', [DokterController::class, 'dokter_edit'])->middleware('auth', 'role:1');

//Admin : dokter -> Edit Data
Route::post('/admin-area/dokter/edit/update', [DokterController::class, 'dokter_update'])->middleware('auth', 'role:1');

//Admin : dokter -> Delete Data
Route::get('/admin-area/dokter/delete/{id}', [DokterController::class, 'dokter_delete'])->middleware('auth', 'role:1');

//Admin : Login Page
Route::get('/login', [AdminController::class, 'login'])->name('login')->middleware('guest');
Route::get('/registrasi', [AdminController::class, 'registrasi'])->name('registrasi')->middleware('guest');

//Admin : Verify Login
Route::post('/login', [AkunController::class, 'login']);

//Admin : Logout
Route::post('/logout', [AkunController::class, 'logout'])->middleware('auth');

//print
Route::get('invoice', function () {
    return view('invoice');
});

//WA
Route::get('payment/success', [TransaksiController::class, 'success'])->middleware('auth', 'role:1,3')->name('payment.success');

//appointment
Route::get('/appointment/{id}', [MainController::class, 'appointment'])->name('appointment.show')->middleware('auth', 'role:1,3');

//payment
Route::get('payment/appointment/{id}', [TransaksiController::class, 'payment'])->name('payment.appointment')->middleware('auth', 'role:1,3');

//appointment
Route::post('/appointment', [PasienController::class, 'pasien_submit'])->middleware('auth', 'role:1,3');

//payment store
Route::post('payment/callback', [ApiController::class, 'callback']);
// frontsite
Route::group(['middleware' => ['auth', 'role:1,3']], function () {


    // payment page
    // grouping route custom from controller or route excluding controller resource
    Route::controller(TransaksiController::class)->group(function () {
        Route::get('payment/success', 'success')->name('payment.success');
        Route::get('payment/appointment/{id}', 'payment')->name('payment.appointment');
    });
    Route::resource('payment', TransaksiController::class);
});
