<?php

use App\Exports\STRExport;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\DiklatController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\HariBesarController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\GolonganController;
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



Route::resource('/str', STRController::class);
Route::get('/exportSTR', [STRController::class, 'export_excel'])->name('str_export');
Route::get('/str/{pegawai:id}/history', [STRController::class, 'history'])->name('str.history');

// sip
Route::resource('/sip', SIPController::class);
Route::get('/sip/{pegawai:id}/history', [SIPController::class, 'history'])->name('sip.history');



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
