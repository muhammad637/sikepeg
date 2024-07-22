<?php

use App\Console\Commands\KenaikanPangkat;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SIPController;
use App\Http\Controllers\STRController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DiklatController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HariBesarController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\PromosiDemosiController;
use App\Http\Controllers\KenaikanPangkatController;
use App\Http\Controllers\MasterDataTahunCuti;
use App\Http\Controllers\MasterDataKenaikanPangkatController;
use App\Models\Jabatan;
use Symfony\Component\HttpKernel\Profiler\Profile;

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
    Route::middleware(['guest:admin','guest:pegawai'])->group(function () {
        Route::view('/login', 'auth.admin.login')->name('login');
        Route::view('/', 'auth.admin.login')->name('login.admin');
        Route::post('/login_handler', [AdminController::class, 'loginHandler'])->name('login_handler');
    });

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/home', [DashboardAdminController::class, 'index'])->name('home.index');
        Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard.index');
        Route::prefix('reminder')->name('reminder.')->group(function () {
            Route::get('/str', [STRController::class, 'reminderSTR'])->name('str.index');
            Route::get('/sip', [SIPController::class, 'reminderSIP'])->name('sip.index');
        });
        Route::get('/notifikasi', [NotifikasiController::class, 'notifAdmin'])->name('notifikasi');

        Route::post('/pegawai/import_excel', [PegawaiController::class, 'import_excel'])->name('import_excel');
        Route::prefix('pegawai')->name('pegawai.')->group(function () {
            Route::get('/template-pns', [PegawaiController::class, 'templatePNS'])->name('template-pns');
            Route::get('/dataPegawai', [PegawaiController::class, 'dataPegawai'])->name('dataPegawai');
            Route::get('/', [PegawaiController::class, 'index'])->name('index');

            Route::get('/searchPegawai', [PegawaiController::class, 'searchPegawai'])->name('searchPegawai');
            Route::get('/create', [PegawaiController::class, 'create'])->name('create');
            Route::get('/{pegawai:id}/edit', [PegawaiController::class, 'edit'])->name('edit');
            Route::post('/store', [PegawaiController::class, 'store'])->name('store');
            Route::get('/{pegawai:id}', [PegawaiController::class, 'show'])->name('show');
            Route::put('/{pegawai:id}/update', [PegawaiController::class, 'update'])->name('update');
        });

        // str
        Route::group(['prefix' => 'str'], function () {
            Route::get('/{pegawai:id}/riwayat', [STRController::class, 'riwayat'])->name('str.riwayat');
            Route::get('/show-riwayat/{str}', [STRController::class, 'showRiwayat'])->name('str.show-riwayat');
            Route::get('/edit-riwayat/{str}', [STRController::class, 'editRiwayat'])->name('str.edit-riwayat');
            Route::get('/export', [STRController::class, 'export_excel'])->name('str.export');
        });
        Route::resource('/str', STRController::class);

        // sip
        Route::prefix('/sip')->name('sip.')->group(function () {

            Route::get('/show-riwayat/{sip}', [SIPController::class, 'showRiwayat'])->name('show-riwayat');
            Route::get('/edit-riwayat/{sip}', [SIPController::class, 'editRiwayat'])->name('edit-riwayat');
            // Route::delete('/delete/{sip}', [SIPController::class, 'delete'])->name('destro');
            Route::get('/export', [SIPController::class, 'export_excel'])->name('export');

            Route::get('/{pegawai:id}/riwayat', [SIPController::class, 'history'])->name('riwayat');
        });
        Route::resource('/sip', SIPController::class);
        Route::get('/testing', function () {
            return 'ahay';
        });


        Route::prefix('cuti')->name('cuti.')->group(function () {
            Route::post('/tambah-cuti-masa-lalu', [CutiController::class, 'tambahCutiMasaLalu'])->name('tambah-cuti-masa-lalu');
            Route::get('/show/{cuti:id}', [CutiController::class, 'show'])->name('show');
            Route::group(['prefix' => '/data-cuti-aktif'], function () {
                Route::get('/', [CutiController::class, 'index'])->name('data-cuti-aktif.index');
                Route::get('/create', [CutiController::class, 'create'])->name('data-cuti-aktif.create');
                Route::get('/edit/{cuti:id}', [CutiController::class, 'edit'])->name('data-cuti-aktif.edit');
                Route::get('/{cuti:id}', [CutiController::class, 'show'])->name('data-cuti-aktif.show');
                Route::post('/store', [CutiController::class, 'store'])->name('data-cuti-aktif.store');
                Route::put('/update/{cuti:id}', [CutiController::class, 'update'])->name('data-cuti-aktif.update');
            });
            Route::prefix('/histori-cuti')->name('histori-cuti.')->group(function () {
                Route::get('/', [CutiController::class, 'historiCuti'])->name('index');
                Route::get('/pegawai/{id}', [CutiController::class, 'riwayatCutiPegawai'])->name('pegawai');
                Route::get('/exportAll', [CutiController::class, 'exportAll'])->name('export-all');
                Route::get('/exportPertahun', [CutiController::class, 'exportPertahun'])->name('export-year');
                Route::get('/show/{cuti:id}', [CutiController::class, 'showRiwayat'])->name('showRiwayat');
                Route::get('/edit/{cuti:id}', [CutiController::class, 'editRiwayat'])->name('editRiwayat');
            });
        });

        Route::get('/mutasi/export-excel', [MutasiController::class, 'export_excel'])->name('mutasi.export-excel');
        Route::resource('/mutasi', MutasiController::class);
        Route::get('/mutasi/history/{pegawai:id}', [MutasiController::class, 'history'])->name('mutasi.history');
        Route::get('/mutasi/edit-history/{mutasi:id}', [MutasiController::class, 'historyEdit'])->name('mutasi.history-edit');
        Route::get('/mutasi/show-history/{mutasi:id}', [MutasiController::class, 'historyShow'])->name('mutasi.history-show');

        Route::prefix('diklat')->name('diklat.')->group(function () {
            Route::get('/riwayat/{pegawai:id}', [DiklatController::class, 'riwayat'])->name('riwayat');
            Route::get('/show-riwayat/{diklat:id}', [DiklatController::class, 'showRiwayat'])->name('show-riwayat');
            Route::get('/edit-riwayat/{diklat:id}', [DiklatController::class, 'editRiwayat'])->name('edit-riwayat');
            Route::get('/export-all', [DiklatController::class, 'exportAll'])->name('export-all');
            Route::get('/export-year', [DiklatController::class, 'exportYear'])->name('export-year');
            Route::get('/export-year-range', [DiklatController::class, 'exportYearRange'])->name('export-range');
        });
        Route::resource('/diklat', DiklatController::class);


        Route::post('/profile/{admin:id}', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/profile/{admin:id}/password', [ProfileController::class, 'password'])->name('profile.password');




        Route::prefix('jabatan')->name('jabatan.')->group(function () {
            Route::get('/', [PromosiDemosiController::class, 'index'])->name('index');
            Route::get('/show/{promosiDemosi:id}', [PromosiDemosiController::class, 'show'])->name('show');
            Route::get('/create', [PromosiDemosiController::class, 'create'])->name('create');
            Route::post('/store', [PromosiDemosiController::class, 'store'])->name('store');
            Route::get('/edit/{promosiDemosi:id}', [PromosiDemosiController::class, 'edit'])->name('edit');
            Route::put('/update/{promosiDemosi:id}', [PromosiDemosiController::class, 'update'])->name('update');
            Route::delete('/delete/{promosiDemosi:id}', [PromosiDemosiController::class, 'destroy'])->name('destroy');
            Route::get('/export-semua-jabatan', [PromosiDemosiController::class, 'export_excel'])->name('export-semua-jabatan');
            Route::get('/riwayat-jabatan/{pegawai:id}', [PromosiDemosiController::class, 'riwayat'])->name('riwayat');
        });

        // kenaikan pangkat


        Route::prefix('kenaikan-pangkat')->name('kenaikan-pangkat.')->group(function () {
            Route::get('/export_excel', [KenaikanPangkatController::class, 'export_excel'])->name('export-excel');
            Route::delete('/{kenaikan_pangkat:id}/delete', [KenaikanPangkatController::class, 'destroy'])->name('destroy');
            Route::get('/', [KenaikanPangkatController::class, 'index'])->name('index');
            Route::get('/create', [KenaikanPangkatController::class, 'create'])->name('create');
            Route::get('/{kenaikan_pangkat}/edit', [KenaikanPangkatController::class, 'edit'])->name('edit');
            Route::get('/{kenaikan_pangkat}', [KenaikanPangkatController::class, 'show'])->name('show');
            Route::post('/store', [KenaikanPangkatController::class, 'store'])->name('store');
            Route::put('/{kenaikan_pangkat}/update', [KenaikanPangkatController::class, 'update'])->name('update');
            Route::get('/riwayat/{pegawai:id}', [KenaikanPangkatCOntroller::class, 'riwayat'])->name('riwayat');
            Route::get('/lihat-riwayat/{kenaikan_pangkat:id}', [KenaikanPangkatController::class, 'lihatRiwayat'])->name('lihat-riwayat');
            Route::get('/edit-riwayat/{kenaikan_pangkat:id}', [KenaikanPangkatController::class, 'editRiwayat'])->name('edit-riwayat');
            Route::get('/riwayat/{pegawai:id}/create', [KenaikanPangkatController::class, 'createriwayat'])->name('createriwayat');
        });
        Route::prefix('master-data')->name('master-data.')->group(function () {
            Route::prefix('admin-management')->name('admin-management.')->group(function(){
                Route::get('/',[AdminController::class,'index'])->name('index');
                Route::post('/store',[AdminController::class,'store'])->name('store');
                Route::put('/update/{admin:id}',[AdminController::class,'update'])->name('update');
                Route::put('/reset/{admin:id}',[AdminController::class,'reset'])->name('reset');
            });
            Route::prefix('cuti-pegawai')->name('cuti-pegawai.')->group(function () {
                Route::get('/', [MasterDataTahunCuti::class, 'index'])->name('index');
                Route::put('/update', [MasterDataTahunCuti::class, 'update'])->name('update');
            });
            Route::prefix('kenaikan-pangkat')->name('kenaikan-pangkat.')->group(function () {
                Route::get('/', [MasterDataKenaikanPangkatController::class, 'index'])->name('index');
                Route::put('/update', [MasterDataKenaikanPangkatController::class, 'update'])->name('update');
            });
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
