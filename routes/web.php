<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/sdm/karyawan', [App\Http\Controllers\KaryawanController::class, 'index'])->name('karyawan');
Route::post('/sdm/karyawan/store', [App\Http\Controllers\KaryawanController::class, 'store'])->name('karyawan.store');
Route::get('/sdm/karyawan/edit/{id}', [App\Http\Controllers\KaryawanController::class, 'edit'])->name('karyawan.edit');
Route::post('/sdm/karyawan/update/{id}', [App\Http\Controllers\KaryawanController::class, 'update'])->name('karyawan.update');
Route::get('/sdm/karyawan/delete/{id}', [App\Http\Controllers\KaryawanController::class, 'destroy'])->name('karyawan.delete');
Route::get('/sdm/karyawan/show/{id}', [App\Http\Controllers\KaryawanController::class, 'show'])->name('karyawan.show');

Route::get('/sdm/pengajuan', [App\Http\Controllers\PengajuanController::class, 'indexsdm'])->name('sdm.pengajuan');
Route::post('/sdm/pengajuan/store', [App\Http\Controllers\PengajuanController::class, 'store'])->name('sdm.pengajuan.store');

Route::get('/karyawan/pengajuan', [App\Http\Controllers\PengajuanController::class, 'index'])->name('pengajuan');
Route::post('/karyawan/pengajuan/store', [App\Http\Controllers\PengajuanController::class, 'store'])->name('pengajuan.store');

Route::get('/atasan/approve.pengajuan', [App\Http\Controllers\PengajuanController::class, 'index'])->name('approve.pengajuan');

Route::get(uri: '/jatahcuti', action: [App\Http\Controllers\JatahcutiController::class, 'index'])->name('jatahcuti');
Route::post('/jatahcuti/store', [App\Http\Controllers\JatahcutiController::class, 'store'])->name('jatahcuti.store');

Route::get('/riwayat', [App\Http\Controllers\RiwayatController::class, 'index'])->name('riwayat');

Route::get('/struktur-organisasi', [App\Http\Controllers\StrukturOrganisasiController::class, 'index'])->name('strukturorganisasi');
Route::post('/struktur-organisasi/store', [App\Http\Controllers\StrukturOrganisasiController::class, 'store'])->name('strukturorganisasi.store');
