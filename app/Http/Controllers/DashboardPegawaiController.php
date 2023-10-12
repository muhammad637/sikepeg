<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use App\Models\KenaikanPangkat;
use App\Models\Pegawai;
use App\Models\Mutasi;
use Illuminate\Http\Request;

class DashboardPegawaiController extends Controller
{

    public function index(Pegawai $pegawai)
    {

        return auth()->guard('pegawai')->user();
        $mutasi = Mutasi::where('pegawai_id', $pegawai->id);
        $diklat = Diklat::where('pegawai_id', $pegawai->id)->orderBy('tanggal_sertifikat', 'desc')->first();
        $kenaikanpangkat = KenaikanPangkat::where('pegawai_id', $pegawai->id)->orderBy('tmt_pangkat_dari', 'desc')->first();
        return view('pages.dashboard.dashboardpegawai', [
            'pegawai' => $pegawai,
            'KenaikanPangkat' => $kenaikanpangkat,
            'Diklat' => $diklat,
            'Mutasi' => $mutasi
        ]);
    }



    public function riwayatKenaikanPangkat(Pegawai $pegawai, KenaikanPangkat $kenaikanpangkat)
    {
        $kenaikanpangkat = KenaikanPangkat::where('pegawai_id', $pegawai->id)->orderBy('tanggal_sk', 'desc')->get();
        return view('pages.kenaikan_pangkat.riwayatpegawai', [
            'pegawai' => $pegawai,
            'kenaikanpangkat' => $kenaikanpangkat
        ]);
    }


    public function historyMutasiPegawai(Pegawai $pegawai)
    {
        $mutasi = Mutasi::where('pegawai_id', $pegawai->id)->orderBy('tanggal_sk', 'desc')->get();
        return view('pages.mutasi.historypegawai', [
            'pegawai' => $pegawai,
            'mutasi' => $mutasi
        ]);
    }
    //
}
