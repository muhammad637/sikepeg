<?php

use App\Models\Asn;
use App\Models\STR;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PegawaiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::middleware('')
// Route::resource('/pegawai', PegawaiController::class);
Route::post('/user', [UserController::class, 'store']);
// Route::resource('STR', PegawaiController::class);
// Route::resource('SIP', PegawaiController::class);
// Route::resource('pegawai',PegawaiController::class);
