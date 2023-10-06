<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SIPController;
use App\Http\Controllers\STRController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DiklatController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\HariBesarController;
use App\Http\Controllers\KenaikanPangkatController;

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

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest:admin'])->group(function () {
        Route::view('/login', 'auth.admin.login')->name('login');
        Route::post('/login_handler', [AdminController::class, 'loginHandler'])->name('login_handler');
    });
    Route::middleware(['auth:admin'])->group(function () {
        Route::view('/home', 'pages.dashboard.index')->name('home');
        Route::view('/dashboard', 'pages.dashboard.index')->name('dashboard.index');
        Route::resource('/pegawai', PegawaiController::class);
        Route::post('/pegawai/import_excel', [PegawaiController::class, 'import_excel'])->name('import_excel');
        Route::group(['prefix' => 'pegawai'], function () {
            Route::group(['prefix' => 'filter'], function () {
                Route::get('/jenisKelamin', [PegawaiController::class, 'jenisKelamin'])->name('pegawai.filter.jenisKelamin');
                Route::get('/statusPegawai', [PegawaiController::class, 'statusPegawai'])->name('pegawai.filter.statuspegawai');
                Route::get('/statusTenaga', [PegawaiController::class, 'statusTenaga'])->name('pegawai.filter.statusTenaga');
                Route::get('/statusTipe', [PegawaiController::class, 'statusTipe'])->name('pegawai.filter.statusTipe');
                Route::get('/JenisTenaga', [PegawaiController::class, 'JenisTenaga'])->name('pegawai.filter.jenisTenaga');
            });
        });

        // str
        Route::resource('/str', STRController::class);
        Route::group(['prefix' => 'str'], function () {
            Route::get('/{pegawai:id}/history', [STRController::class, 'history'])->name('str.history');
            Route::get('/export', [STRController::class, 'export'])->name('str.export');
        });
        // sip
        Route::resource('/sip', SIPController::class);
        Route::get('/sip/{pegawai:id}/history', [SIPController::class, 'history'])->name('sip.history');
        Route::resource('/hariBesar', HariBesarController::class);
        Route::group(['prefix' => 'cuti'], function () {
            Route::group(['prefix' => '/data-cuti-aktif'], function () {
                Route::get('/', [CutiController::class, 'index'])->name('data-cuti-aktif.index');
                Route::get('/create', [CutiController::class, 'create'])->name('data-cuti-aktif.create');
                Route::get('/edit/{cuti:id}', [CutiController::class, 'edit'])->name('data-cuti-aktif.edit');
                Route::get('/{cuti:id}', [CutiController::class, 'show'])->name('data-cuti-aktif.show');
                Route::post('/store', [CutiController::class, 'store'])->name('data-cuti-aktif.store');
                Route::put('/update/{cuti:id}', [CutiController::class, 'update'])->name('data-cuti-aktif.update');
            });
            Route::group(['prefix' => 'histori-cuti'], function () {
                Route::get('/', [CutiController::class, 'historiCuti'])->name('histori-cuti.index');
            });
        });
        Route::resource('/mutasi', MutasiController::class);
        Route::get('/mutasi/history/{pegawai:id}', [MutasiController::class, 'history'])->name('mutasi.history');
        Route::resource('/diklat', DiklatController::class);
        Route::get('/diklat/riwayat/{pegawai:id}', [DiklatController::class, 'riwayat'])->name('diklat.riwayat');
        Route::resource('/kenaikan_pangkat', KenaikanPangkatController::class);
        Route::get('/kenaikan_pangkat/riwayat/{pegawai:id}', [KenaikanPangkatController::class, 'riwayat'])->name('kenaikan_pangkat.riwayat');
        Route::post('/logout', [AdminController::class, 'logoutHandler'])->name('logout');
    });
});
