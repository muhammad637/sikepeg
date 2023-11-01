<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SIPController;
use App\Http\Controllers\STRController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DiklatController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\HariBesarController;
use App\Http\Controllers\KenaikanPangkatController;

use App\Http\Controllers\RuanganController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\GolonganController;

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
        Route::get('/home',[DashboardAdminController::class,'index'])->name('home.index');
        Route::get('/dashboard',[DashboardAdminController::class,'index'])->name('dashboard.index');
        Route::prefix('reminder')->name('reminder.')->group(function(){
            Route::get('/str', [STRController::class,'reminderSTR'])->name('str.index');
            Route::get('/sip', [SIPController::class,'reminderSIP'])->name('sip.index');
        });
        // Route::resource('/pegawai', PegawaiController::class);
        Route::post('/pegawai/import_excel', [PegawaiController::class, 'import_excel'])->name('import_excel');
        Route::prefix('pegawai')->name('pegawai.')->group(function () {
            Route::get('/dataPegawai', [PegawaiController::class, 'dataPegawai'])->name('dataPegawai');
            Route::get('/', [PegawaiController::class, 'index'])->name('index');
            Route::get('/searchPegawai',[PegawaiController::class,'searchPegawai'])->name('searchPegawai');         
            Route::get('/create', [PegawaiController::class,'create'])->name('create');         
            Route::get('/{pegawai:id}/edit',[PegawaiController::class,'edit'])->name('edit');         
            Route::post('/store', [PegawaiController::class, 'store'])->name('store');
            Route::get('/{pegawai:id}', [PegawaiController::class, 'show'])->name('show');
            Route::put('/{pegawai:id}/update', [PegawaiController::class, 'update'])->name('update');
            Route::prefix('filter')->name('filter.')->group(function () {
                Route::get('/jenisKelamin', [PegawaiController::class, 'jenisKelamin'])->name('jenisKelamin');
                Route::get('/statusPegawai', [PegawaiController::class, 'statusPegawai'])->name('statuspegawai');
                Route::get('/statusTenaga', [PegawaiController::class, 'statusTenaga'])->name('statusTenaga');
                Route::get('/statusTipe', [PegawaiController::class, 'statusTipe'])->name('statusTipe');
                Route::get('/JenisTenaga', [PegawaiController::class, 'JenisTenaga'])->name('jenisTenaga');
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

        Route::prefix('cuti')->name('cuti.')->group(function () {
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

        // kenaikan pangkat
        Route::prefix('kenaikan-pangkat')->name('kenaikan-pangkat.')->group(function(){
            Route::get('/', [KenaikanPangkatController::class,'index'])->name('index');
            Route::get('/create',[KenaikanPangkatController::class,'create'])->name('create');
            Route::get('/{kenaikan_pangkat}/edit',[KenaikanPangkatController::class,'edit'])->name('edit');
            Route::get('/{kenaikan_pangkat}',[KenaikanPangkatController::class,'show'])->name('show');
            Route::post('/store',[KenaikanPangkatController::class,'store'])->name('store');
            Route::put('/{kenaikan_pangkat}/update',[KenaikanPangkatController::class,'update'])->name('update');
            Route::get('/riwayat/{pegawai:id}',[KenaikanPangkatCOntroller::class,'riwayat'])->name('riwayat');
        });
        // Route::resource('/kenaikan_pangkat', KenaikanPangkatController::class);
        // Route::get('/kenaikan_pangkat/riwayat/{pegawai:id}', [KenaikanPangkatController::class, 'riwayat'])->name('kenaikan_pangkat.riwayat');
        // master-data
        Route::prefix('master-data')->name('master-data.')->group(function () {
            // hari-besar
            Route::prefix('hari-besar')->name('hari-besar.')->group(function () {
                Route::get('/', [HariBesarController::class, 'index'])->name('index');
                Route::get('/create', [HariBesarController::class, 'create'])->name('create');
                Route::post('/store', [HariBesarController::class, 'store'])->name('store');
                Route::get('/{hariBesar}/edit', [HariBesarController::class, 'edit'])->name('edit');
                Route::put('/{hariBesar}', [HariBesarController::class, 'update'])->name('update');
                Route::delete('/{hariBesar}/delete', [HariBesarController::class, 'destroy'])->name('destroy');
            });
            Route::resource('/ruangan', RuanganController::class);
            Route::resource('/pangkat', PangkatController::class);
            Route::resource('/golongan', GolonganController::class);
        });
        Route::post('/logout', [AdminController::class, 'logoutHandler'])->name('logout');
    });
});
