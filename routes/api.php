<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\API\PDFController;
use App\Http\Controllers\API\SIPController;
use App\Http\Controllers\API\STRController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CutiController;
use App\Http\Controllers\API\DiklatController;
use App\Http\Controllers\API\MutasiController;
use App\Http\Controllers\API\JabatanController;
use App\Http\Controllers\API\KenaikanPangkatController;

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


// downloadPDF
Route::get('/testingPDF', [PDFController::class, 'downloadPDF']);

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
        Route::post('/cuti/store',[CutiController::class,'store']);

        // diklat
        Route::get('/diklat/riwayat', [DiklatController::class, 'index'])->name('diklat.riwayat');
        Route::post('/diklat/store', [DiklatController::class, 'store']);



        // mutasi
        Route::get('/mutasi/riwayat', [MutasiController::class, 'index'])->name('mutasi.riwayat');

        // jabatan
        Route::get('/jabatan/riwayat', [JabatanController::class, 'index'])->name('jabatan.riwayat');

        // kanaikanPangkat
        Route::get('/kenaikan-pangkat/riwayat', [KenaikanPangkatController::class, 'index'])->name('kenaikanPangkat.riwayat');

        // STR
        Route::get('/str/riwayat', [STRController::class, 'index'])->name('str.riwayat');
        Route::post('/str/store', [STRController::class, 'store']);

        // SIP
        Route::get('/sip/riwayat', [SIPController::class, 'index'])->name('sip.riwayat');
        Route::post('/sip/store', [SIPController::class, 'store']);

       
        Route::post('/downloadPDF', [PDFController::class, 'downloadPDF']);
        Route::get('/testing', [PDFController::class, 'tes']);


    
        // logout
        Route::get('/logout', [AuthController::class, 'logoutHandler'])->name('logout_handler');
    });
});

