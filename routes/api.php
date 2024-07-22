<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CutiController;
use App\Http\Controllers\API\DiklatController;
use App\Http\Controllers\API\JabatanController;
use App\Http\Controllers\API\KenaikanPangkatController;
use App\Http\Controllers\API\MutasiController;
use App\Http\Controllers\API\SIPController;
use App\Http\Controllers\API\STRController;

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

Route::get('/testing', function () {
    return "testing";
});

Route::prefix('pegawai')->name('api.pegawai.')->group(function () {
    Route::middleware(['guest:pegawai', 'guest:admin'])->group(function () {
        Route::post('/login', [AuthController::class, 'loginHandler'])->name('login_handler');
    });
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/testing2', function () {
            return response()->json(['data' => "testingoy"]);
        });

        // cuti
        Route::get('/cuti/riwayat', [CutiController::class, 'index'])->name('cuti.riwayat');
        Route::post('/cuti/create',[CutiController::class,'store']);

        // diklat
        Route::get('/diklat/riwayat', [DiklatController::class, 'index'])->name('diklat.riwayat');


        // mutasi
        Route::get('/mutasi/riwayat', [MutasiController::class, 'index'])->name('mutasi.riwayat');

        // jabatan
        Route::get('/jabatan/riwayat', [JabatanController::class, 'index'])->name('jabatan.riwayat');

        // kanaikanPangkat
        Route::get('/kenaikan-pangkat/riwayat', [KenaikanPangkatController::class, 'index'])->name('kenaikanPangkat.riwayat');

        // STR
        Route::get('/str/riwayat', [STRController::class, 'index'])->name('str.riwayat');


        // SIP
        Route::get('/sip/riwayat', [SIPController::class, 'index'])->name('sip.riwayat');

        // logout
        Route::get('/logout', [AuthController::class, 'logoutHandler'])->name('logout_handler');
    });
});

// Route::post('')
// Route::resource('STR', PegawaiController::class);
// Route::resource('SIP', PegawaiController::class);
// Route::resource('pegawai',PegawaiController::class);
