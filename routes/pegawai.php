<?php

use App\Http\Controllers\DashboardPegawaiController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;


Route::prefix('pegawai')->name('pegawai.')->group(function () {
    Route::middleware('guest:pegawai')->group(function () {
        Route::view('/login', 'auth.pegawai.login')->name('login');
        Route::post('/login_handler', [PegawaiController::class, 'loginHandler'])->name('login_handler');
    });
    Route::middleware('auth:pegawai')->group(function () {
       
        Route::get('/logout', [PegawaiController::class, 'logoutHandler'])->name('logout');
    });
//  Route::view('/home', 'pages.dashboard.dashboardpegawai')->name('home');
Route::get('/home/{pegawai:nip_nippk}', [DashboardPegawaiController::class, 'index'])->name('home');
Route::get('/kenaikan_pangkat/riwayat/{pegawai:id}', [DashboardPegawaiController::class, 'riwayatKenaikanPangkat'])->name('kenaikanpangkat.riwayat');
Route::get('/mutasi/history/{pegawai:id}', [DashboardPegawaiController::class, 'historyMutasiPegawai'])->name('mutasi.history');
});
