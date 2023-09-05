<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
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
    $tanggal_pensiun =  "10-12-2022";
    $tanggal_mulai =  "10-12-2022";
    // $parsing_tanggal_pensiun = intval(Carbon::parse($tanggal_pensiun)->format('y'));
    // $parsing_tanggal_mulai = intval(Carbon::parse($tanggal_mulai)->format('y'));
    // return Carbon\Carbon::parse('10-10-2001')->format('y-m-d');
    // return [$parsing_tanggal_mulai, $parsing_tanggal_pensiun];

});


Route::resource('/pegawai', PegawaiController::class);

// str
Route::resource('/str', STRController::class);

// sip //
Route::get('/sip', function () {
    return view('pages.sip.index', );
})->name('sip.index');

// create
Route::get('/sip/create', function () {
    return view('pages.sip.create', );
})->name('sip.create');

//edit
Route::get('/sip/edit', function() {
    return view('pages.sip.edit', );
})->name('sip.edit');

//show
Route::get('/sip/show', function() {
    return view('pages.sip.show',);
})->name('sip.show');

//history
Route::get('/sip/history', function() {
    return view('pages.sip.history',);
})->name('sip.history');

// sip  end //

// cuti
Route::get('/cuti', function () {
    return view('pages.default.maintenance');
})->name('cuti.index');

// histori-cuti
Route::get('/histori-cuti', function () {
    return view('pages.default.maintenance');
})->name('histori-cuti.index');


// mutasi
Route::get('/mutasi', function () {
    return view('pages.default.maintenance');
})->name('mutasi.index');

// diklat
Route::get('/diklat', function () {
    return view('pages.default.maintenance');
})->name('diklat.index');

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
