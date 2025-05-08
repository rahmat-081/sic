<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/karyawan', [App\Http\Controllers\KaryawanController::class, 'index'])->name('karyawan');
Route::post('/karyawan/store', [App\Http\Controllers\KaryawanController::class, 'store'])->name('karyawan.store');
Route::get('/karyawan/edit/{id}', [App\Http\Controllers\KaryawanController::class, 'edit'])->name('karyawan.edit');
Route::post('/karyawan/update/{id}', [App\Http\Controllers\KaryawanController::class, 'update'])->name('karyawan.update');
Route::get('/karyawan/delete/{id}', [App\Http\Controllers\KaryawanController::class, 'destroy'])->name('karyawan.delete');
Route::get('/karyawan/show/{id}', [App\Http\Controllers\KaryawanController::class, 'show'])->name('karyawan.show');
Route::get('/pengajuan', [App\Http\Controllers\PengajuanController::class, 'index'])->name('pengajuan');
Route::post('/pengajuan/store', [App\Http\Controllers\PengajuanController::class, 'store'])->name('pengajuan.store');
Route::get('/riwayat', [App\Http\Controllers\RiwayatController::class, 'index'])->name('riwayat');
