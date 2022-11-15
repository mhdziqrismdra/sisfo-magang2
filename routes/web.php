<?php

use App\Http\Controllers\AkunController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\CetakPenilaianController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MoaController;
use App\Http\Controllers\MouController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\TestController;

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

Route::get('/', function () {
    return view('auth.loginPage');
});

Route::get('login', function () {
    return view('auth.loginPage');
})->name('login');

Route::post('postlogin', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout']);
Route::post('simpanregistrasi', [LoginController::class, 'simpanregistrasi']);


Route::get('forget-password', [LoginController::class, 'getEmail']);
Route::post('forget-password', [LoginController::class, 'postEmail']);

Route::middleware(['auth:user,pengguna', 'ceklevel:Admin,Pegawai'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});

Route::get('test', [TestController::class, 'index']);

Route::middleware(['auth:user', 'ceklevel:Admin'])->group(function () {
    Route::get('akun-pegawai', [AkunController::class, 'index']);
    Route::match(['get', 'post'], 'akun-pegawai/ubah/{id}', [AkunController::class, 'update']);
    Route::get('akun-pegawai/{id}', [AkunController::class, 'destroy']);
    Route::delete('akun-pegawai/{id}', [AkunController::class, 'destroy']);

    Route::get('data-pegawai', [PegawaiController::class, 'index']);
    Route::post('data-pegawai', [PegawaiController::class, 'store']);
    Route::match(['get', 'post'], 'data-pegawai/edit/{nip}', [PegawaiController::class, 'update']);
    Route::get('data-pegawai/{nip}', [PegawaiController::class, 'destroy']);
    Route::delete('data-pegawai/{nip}', [PegawaiController::class, 'destroy']);
    Route::get('data-pegawai/detail/{nip}', [PegawaiController::class, 'show']);


    Route::get('penilaian-prestasi-kerja', [PenilaianController::class, 'index']);
    Route::post('penilaian-prestasi-kerja', [PenilaianController::class, 'store']);
    Route::get('penilaian-prestasi-kerja/rekapitulasi/{nip}', [PenilaianController::class, 'show']);
    Route::get('penilaian-prestasi-kerja/rekapitulasi/{nip}/search', [PenilaianController::class, 'search']);
    Route::get('penilaian-prestasi-kerja/rekap-penilaian', [CetakPenilaianController::class, 'index']);
    Route::get('penilaian-prestasi-kerja/{id_penilaian}', [PenilaianController::class, 'destroy']);
    Route::delete('penilaian-prestasi-kerja/{id_penilaian}', [PenilaianController::class, 'destroy']);
    Route::get('penilaian-prestasi-kerja/cetak/pdf', [CetakPenilaianController::class, 'cetakPDF']);
    Route::get('penilaian-prestasi-kerja/export/pdf/{periode_awal}/{periode_akhir}', [CetakPenilaianController::class, 'pdfExport']);
    Route::get('penilaian-prestasi-kerja/export/pdf', [CetakPenilaianController::class, 'search']);
    // Route::get('penilaian-prestasi-kerja/export/excel/{periode_awal}/{periode_akhir}', [CetakPenilaianController::class, 'penilaianexport']);
    Route::get('penilaian-prestasi-kerja/export/excel/{periode_awal}/{periode_akhir}', [CetakPenilaianController::class, 'exportExcel']);


    Route::get('berkas-dokumen', [DokumenController::class, 'index']);
    Route::get('berkas-dokumen/file/{nip}/', [DokumenController::class, 'create']);
    Route::post('berkas-dokumen', [DokumenController::class, 'store']);
    Route::get('berkas-dokumen/berkas/{nip}', [DokumenController::class, 'show']);
    Route::get('berkas-dokumen/berkas/download/{id_dokumen}', [DokumenController::class, 'download']);
    Route::get('berkas-dokumen/berkas/hapus/{id_dokumen}', [DokumenController::class, 'destroy']);
    Route::delete('berkas-dokumen/berkas/{nip}', [DokumenController::class, 'destroy']);
    Route::get('berkas-dokumen/preview', [DokumenController::class, 'preview']);

    // app\Http\Controllers\MouController.php
    Route::get('mou', [MouController::class, 'index']);
    Route::get('mou/list', [MouController::class, 'list']);
    Route::get('mou/create', [MouController::class, 'create']);
    Route::post('mou/create/action', [MouController::class, 'createAction']);
    Route::put('mou/update', [MouController::class, 'update']);
    Route::post('mou/update/action', [MouController::class, 'updateAction']);
    Route::put('mou/perpanjang', [MouController::class, 'perpanjang']);
    Route::post('mou/perpanjang/action', [MouController::class, 'perpanjangAction']);
    Route::put('mou/detail', [MouController::class, 'detail']);
    Route::get('mou/provinsi', [MouController::class, 'provinsi']);
    Route::get('mou/kabupaten', [MouController::class, 'kotaKabupaten']);
    Route::get('mou/kecamatan', [MouController::class, 'kecamatan']);
    Route::get('mou/kelurahan', [MouController::class, 'kelurahan']);


    // app\Http\Controllers\MoaController.php
    Route::get('moa', [MoaController::class, 'index']);
    Route::get('moa/list', [MoaController::class, 'list']);
    Route::get('moa/create', [MoaController::class, 'create']);
    Route::post('moa/create/action', [MoaController::class, 'createAction']);
    Route::put('moa/update', [MoaController::class, 'update']);
    Route::post('moa/update/action', [MoaController::class, 'updateAction']);
});

Route::middleware(['auth:pengguna', 'ceklevel:Pegawai'])->group(function () {
    Route::get('pegawai/penilaian-prestasi-kerja/rekapitulasi/{nip}', [PenilaianController::class, 'show']);
    Route::get('pegawai/penilaian-prestasi-kerja/rekapitulasi/{nip}/search', [PenilaianController::class, 'search']);

    Route::get('pegawai/berkas-dokumen/file/{nip}/', [DokumenController::class, 'create']);
    Route::post('pegawai/berkas-dokumen', [DokumenController::class, 'storePeg']);
    Route::get('pegawai/berkas-dokumen/berkas/{nip}', [DokumenController::class, 'show']);
    // Route::get('berkas-dokumen/berkas/download/{id_dokumen}', [DokumenController::class, 'download']);
    Route::get('pegawai/berkas-dokumen/berkas/hapus/{id_dokumen}', [DokumenController::class, 'destroyPeg']);
    Route::delete('pegawai/berkas-dokumen/berkas/{nip}', [DokumenController::class, 'destroyPeg']);
});
