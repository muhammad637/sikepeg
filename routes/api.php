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
Route::group(['prefix' => 'pegawai'], function () {
    Route::post('login', 'App\Http\Controllers\PegawaiController@loginHandler');
    Route::middleware('auth:pegawai')->group(function () {
        Route::post('logout', 'App\Http\Controllers\PegawaiController@logoutHandler');
        Route::get('/', 'App\Http\Controllers\PegawaiController@index');
        Route::get('/{id}', 'App\Http\Controllers\PegawaiController@show');
        Route::post('/', 'App\Http\Controllers\PegawaiController@store');
        Route::put('/{id}', 'App\Http\Controllers\PegawaiController@update');
        Route::delete('/{id}', 'App\Http\Controllers\PegawaiController@destroy');
    });
});

