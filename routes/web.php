<?php

use App\Http\Controllers\CutiController;
use App\Http\Controllers\DiklatController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\HariBesarController;
use App\Http\Controllers\KenaikanPangkatController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SIPController;
use App\Http\Controllers\STRController;
use App\Http\Controllers\PegawaiController;


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
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('main');
});

Route::get('/coba', function () {
    $tanggal_pensiun =  "10-12-2001";
    // $tanggal_mulai =  "10-12-2022";
    $parsing_tanggal_pensiun = Carbon::parse($tanggal_pensiun);
    // $parsing_tanggal_mulai = intval(Carbon::parse($tanggal_mulai)->format('y'));
    // return Carbon\Carbon::parse('10-10-2001')->format('y-m-d');
    // return [$parsing_tanggal_mulai, $parsing_tanggal_pensiun];
    $tahun = $parsing_tanggal_pensiun->diffInYears(now());
    $bulan = $parsing_tanggal_pensiun->diffInMonths(now()) % 12;
    return "masa kerja $bulan bulan $tahun tahun";
});


Route::resource('/pegawai', PegawaiController::class);
Route::post('/pegawai/import_excel', [PegawaiController::class, 'import_excel'])->name('import_excel');

// str
Route::resource('/str', STRController::class);
Route::get('/str/{pegawai:id}/history',[STRController::class,'history'])->name('str.history');
// sip
Route::resource('/sip', SIPController::class);
Route::get('/sip/{pegawai:id}/history',[SIPController::class,'history'])->name('sip.history');
Route::resource('/hariBesar', HariBesarController::class);

// 



// data cuti aktif
Route::group(['prefix' => 'cuti'], function(){
    Route::group(['prefix' =>'/data-cuti-aktif'], function(){
        Route::get('/', [CutiController::class, 'index'])->name('data-cuti-aktif.index');
        Route::get('/create', [CutiController::class, 'create'])->name('data-cuti-aktif.create');
        Route::get('/edit', [CutiController::class, 'edit'])->name('data-cuti-aktif.edit');
        Route::get('/{cuti:id}', [CutiController::class, 'show'])->name('data-cuti-aktif.show');
        Route::post('/store', [CutiController::class, 'store'])->name('data-cuti-aktif.store');
        Route::put('/update/{cuti:id}', [CutiController::class, 'update'])->name('data-cuti-aktif.update');
    });
    Route::group(['prefix' => 'histori-cuti'], function(){
        // histori-cuti
        Route::get('/', function () {
            return view('pages.cuti.histori-cuti.index');
        })->name('histori-cuti.index');
    });
});


// mutasi
// Route::get('/mutasi', function () {
//     return view('pages.mutasi.index');
// })->name('mutasi.index');
Route::resource('/mutasi', MutasiController::class);
Route::get('/mutasi/history/{pegawai:id}', [MutasiController::class ,'history'])->name('mutasi.history');
// Route::post('mutasi/index', [MutasiController::class, 'mutasiindex'])->name('mutasi');
// Route::post('mutasi/create' , [MutasiController::class, 'create'])->name('mutasi_create');
// Route::post('mutasi/store', [MutasiController::class, 'store'])->name('mutasi_store');
// Route::post('mutasi/{mutasi:id}/update', [MutasiController::class, 'update'])->name('mutasi_update');
// Route::post('mutasi/{mutasi:id}/update', [MutasiController::class, 'update'])->name('mutasi_update');

// diklat
// Route::res('/diklat', function () {
//     return view('pages.diklat.index');
// })->name('diklat.index');

Route::resource('/diklat', DiklatController::class);
Route::get('/diklat/riwayat/{pegawai:id}', [DiklatController::class, 'riwayat'])->name('diklat.riwayat');


Route::resource('/kenaikan_pangkat', KenaikanPangkatController::class);



// DASHBOARD //
Route::get('/dashboard', function () {
    return view('pages.dashboard.index');
})->name('dashboard.index');


Route::get('/reminderstr', function () {
    return view('pages.dashboard.reminderstr');
})->name('reminderstr.index');


Route::get('/remindersip', function () {
    return view('pages.dashboard.remindersip');
})->name('remindersip.index');
// DASHBOARD END //
