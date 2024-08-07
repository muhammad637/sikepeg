<?php

use App\Http\Controllers\API\DiklatController;
use App\Http\Controllers\JabatanController;
use App\Models\Asn;
use App\Models\STR;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\STRController;
use App\Http\Controllers\SIPController;
use App\Http\Controllers\CutiController;


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
// Route::post('/user', [UserController::class, 'store']);
// Route::resource('STR', PegawaiController::class);
// Route::resource('SIP', PegawaiController::class);
Route::prefix('pegawai')->group(function () {
    // Route untuk login
    Route::post('login', [PegawaiController::class, 'loginHandler']);
    
    // Route yang memerlukan autentikasi
    Route::middleware('auth:sanctum')->group(function () {
        // Route untuk logout
        Route::post('logout', [PegawaiController::class, 'logoutHandler']);
        
        // Route untuk pegawai
        Route::get('/', [PegawaiController::class, 'index']);
        Route::get('/profile', [PegawaiController::class, 'show']);
        
        // Route untuk jabatan
        Route::get('/jabatan', [JabatanController::class, 'index']);
        
        // Route untuk STR
        Route::get('/str', [STRController::class, 'index']);
        Route::post('/str', [STRController::class, 'store']);
        Route::get('/str/{str}', [STRController::class, 'show']);
        Route::put('/str/{str}', [STRController::class, 'update']);
        Route::delete('/str/{str}', [STRController::class, 'destroy']);
        
        // Route untuk SIP
        Route::apiResource('sip', SIPController::class);
        Route::get('sip/{pegawai}/history', [SIPController::class, 'history']);
        Route::get('sip/{sip}/show-riwayat', [SIPController::class, 'showRiwayat']);
        Route::get('sip/{sip}/edit-riwayat', [SIPController::class, 'editRiwayat']);
        
        // Route untuk cuti
        Route::resource('cuti', CutiController::class);
        Route::post('cuti', [CutiController::class, 'store']);
        
        // Route untuk diklat
        Route::prefix('diklat')->group(function () {
            Route::get('/', [DiklatController::class, 'index']);
            Route::post('/', [DiklatController::class, 'store']);
            Route::get('/{diklat}', [DiklatController::class, 'show']);
            Route::put('/{diklat}', [DiklatController::class, 'update']);
            Route::delete('/{diklat}', [DiklatController::class, 'destroy']);
            Route::get('/{pegawai}/riwayat', [DiklatController::class, 'riwayat']);
            Route::get('/{diklat}/show-riwayat', [DiklatController::class, 'showRiwayat']);
            Route::get('/{diklat}/edit-riwayat', [DiklatController::class, 'editRiwayat']);
            Route::get('/export/all', [DiklatController::class, 'exportAll']);
            Route::get('/export/year', [DiklatController::class, 'exportYear']);
            Route::get('/export/year-range', [DiklatController::class, 'exportYearRange']);
        });
    });
});


