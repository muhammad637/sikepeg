<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use App\Models\KenaikanPangkat;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class DashboardPegawaiController extends Controller
{

    public function index(Pegawai $pegawai){
        $diklat = Diklat::where('pegawai_id', $pegawai->id)->orderBy('tanggal_sertifikat', 'desc')->first();
        $kenaikanpangkat = KenaikanPangkat::where('pegawai_id', $pegawai->id)->orderBy('tmt_pangkat_dari', 'desc')->first();
        return view('pages.dashboard.dashboardpegawai', [
            'pegawai' => $pegawai,
            'KenaikanPangkat' => $kenaikanpangkat,
            'Diklat' => $diklat
        ]);
    }
    //
}
