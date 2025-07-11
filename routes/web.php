<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth', 'check.level:Direktur,Kepala Regu,Kepala Seksi,Manager'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/atasan/approve/pengajuan', [App\Http\Controllers\RiwayatController::class, 'index'])->name('approve.pengajuan');
    Route::post('/atasan/approve/store', [App\Http\Controllers\RiwayatController::class, 'store'])->name('approve.store');
    Route::get('/atasan/approve/edit/{id}', [App\Http\Controllers\RiwayatController::class, 'edit'])->name('approve.edit');
    Route::post('/atasan/approve/update/{id}', [App\Http\Controllers\RiwayatController::class, 'update'])->name('approve.update');
    Route::get('/atasan/pengajuan', [App\Http\Controllers\PengajuanController::class, 'index'])->name('atasan.pengajuan');
    Route::post('/atasan/pengajuan/store', [App\Http\Controllers\PengajuanController::class, 'store'])->name('atasan.pengajuan.store');
    Route::get('/atasan/struktur-organisasi', [App\Http\Controllers\StrukturOrganisasiController::class, 'index'])->name('atasan.strukturorganisasi');
    Route::post('/atasan/struktur-organisasi/store', [App\Http\Controllers\StrukturOrganisasiController::class, 'store'])->name('atasan.strukturorganisasi.store');
    Route::get('/atasan/riwayat',[App\Http\Controllers\RiwayatController::class,'show_atasan'])->name('atasan.riwayat');
});

Route::middleware(['auth', 'check.level:unit:SDM'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/sdm/karyawan', [App\Http\Controllers\KaryawanController::class, 'index'])->name('karyawan');
    Route::post('/sdm/karyawan/store', [App\Http\Controllers\KaryawanController::class, 'store'])->name('karyawan.store');
    Route::get('/sdm/karyawan/edit/{id}', [App\Http\Controllers\KaryawanController::class, 'edit'])->name('karyawan.edit');
    Route::post('/sdm/karyawan/update/{id}', [App\Http\Controllers\KaryawanController::class, 'update'])->name('karyawan.update');
    Route::get('/sdm/karyawan/delete/{id}', [App\Http\Controllers\KaryawanController::class, 'destroy'])->name('karyawan.delete');
    Route::get('/sdm/karyawan/show/{id}', [App\Http\Controllers\KaryawanController::class, 'show'])->name('karyawan.show');
    Route::get('/sdm/pengajuan', [App\Http\Controllers\PengajuanController::class, 'index'])->name('sdm.pengajuan');
    Route::post('/sdm/pengajuan/store', [App\Http\Controllers\PengajuanController::class, 'store'])->name('sdm.pengajuan.store');
    Route::get(uri: '/jatahcuti', action: [App\Http\Controllers\JatahcutiController::class, 'index'])->name('jatahcuti');
    Route::post('/jatahcuti/store', [App\Http\Controllers\JatahcutiController::class, 'store'])->name('jatahcuti.store');
    Route::get('/struktur-organisasi', [App\Http\Controllers\StrukturOrganisasiController::class, 'index'])->name('strukturorganisasi');
    Route::post('/struktur-organisasi/store', [App\Http\Controllers\StrukturOrganisasiController::class, 'store'])->name('strukturorganisasi.store');
    Route::get('/sdm/riwayat',[App\Http\Controllers\RiwayatController::class,'show'])->name('sdm.riwayat');
    Route::get('/sdm/jabatan',[App\Http\Controllers\RiwayatJabatanController::class,'index'])->name('jabatan');
    Route::post('/sdm/jabatan/store', [App\Http\Controllers\RiwayatJabatanController::class, 'store'])->name('jabatan.store');
    Route::get('/sdm/jabatan/edit/{id}', [App\Http\Controllers\RiwayatJabatanController::class,'edit'])->name('jabatan.edit');
    Route::post('/sdm/jabatan/update/{id}', [App\Http\Controllers\RiwayatJabatanController::class,'update'])->name('jabatan.update');
});

Route::middleware(['auth', 'check.level:Pelaksana'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/karyawan/pengajuan', [App\Http\Controllers\PengajuanController::class, 'index'])->name('pengajuan');
    Route::post('/karyawan/pengajuan/store', [App\Http\Controllers\PengajuanController::class, 'store'])->name('pengajuan.store');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
