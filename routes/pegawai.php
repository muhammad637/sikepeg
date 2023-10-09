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
Route::get('/home', [DashboardPegawaiController::class, 'index'])->name('home');
});
