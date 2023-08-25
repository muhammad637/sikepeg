<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

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
    $parsing_tanggal_pensiun = intval(Carbon::parse($tanggal_pensiun)->format('y'));
    $parsing_tanggal_mulai = intval(Carbon::parse($tanggal_mulai)->format('y'));
    // return [$parsing_tanggal_mulai, $parsing_tanggal_pensiun];
    
});
