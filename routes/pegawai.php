<?php

use App\Http\Controllers\DashboardPegawaiController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PersonalFileController;
use Illuminate\Support\Facades\Route;


Route::prefix('pegawai')->name('pegawai.')->group(function () {
    Route::middleware('guest:pegawai')->group(function () {
        Route::view('/login', 'auth.pegawai.login')->name('login');
        Route::post('/login_handler', [PegawaiController::class, 'loginHandler'])->name('login_handler');
        
    });
    Route::middleware('auth:pegawai')->group(function () {
        Route::post('/logout', [PegawaiController::class, 'logoutHandler'])->name('logout');
        Route::get('/home', [DashboardPegawaiController::class, 'index'])->name('home');
        Route::get('/personalfile', [PersonalFileController::class, 'index'])->name('personal-file');
        Route::get('/kenaikan_pangkat/riwayat', [DashboardPegawaiController::class, 'riwayatKenaikanPangkat'])->name('kenaikanpangkat.riwayat');
        Route::get('/mutasi/history', [DashboardPegawaiController::class, 'historyMutasiPegawai'])->name('mutasi.history');
        Route::get('/diklat/history', [DashboardPegawaiController::class, 'historyDiklatPegawai'])->name('diklat.history');
        Route::get('/str/history', [DashboardPegawaiController::class, 'historySTRPegawai'])->name('str.history');
        Route::get('/sip/history', [DashboardPegawaiController::class, 'historySIPPegawai'])->name('sip.history');
        Route::get('/cuti/history', [DashboardPegawaiController::class, 'historyCutiPegawai'])->name('cuti.history');
    });
//  Route::view('/home', 'pages.dashboard.dashboardpegawai')->name('home');


});
