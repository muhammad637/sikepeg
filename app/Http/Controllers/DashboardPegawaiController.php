<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Diklat;
use App\Models\KenaikanPangkat;
use App\Models\Pegawai;
use App\Models\Mutasi;
use App\Models\STR;
use App\Models\SIP;
use App\Models\Cuti;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class DashboardPegawaiController extends Controller
{
    public function index()
    {
        $today = Carbon::now(); // Mengambil tanggal dan waktu saat ini
        $nextWeek = $today->copy()->addDays(7); // Menambahkan 7 hari ke tanggal saat ini

        $employees = Pegawai::all(); // Mengambil semua pegawai (gantilah ini dengan query yang sesuai ke database)

        $upcomingBirthdays = [];

        foreach ($employees as $employee) {
            $birthdate = Carbon::createFromFormat('Y-m-d', $employee->tanggal_lahir);
            $birthdayThisYear = $birthdate->copy()->year($today->year); // Mengatur tahun ulang tahun sesuai dengan tahun saat ini
            $birthdayNextYear = $birthdate->copy()->year($today->year + 1); // Mengatur tahun ulang tahun sesuai dengan tahun depan
            if ($today->lte($birthdayThisYear) && $birthdayThisYear->lte($nextWeek)) {
                $upcomingBirthdays[] = $employee;
            } elseif ($today->lte($birthdayNextYear) && $birthdayNextYear->lte($nextWeek)) {
                $upcomingBirthdays[] = $employee;
            }
            if($today->isSameDay($birthdayThisYear)){
                $upcomingBirthdays[] = $employee;
            }
        }
        // $notif = Pegawai::with(['notifikasi' => function ($q) {
        //     $q->orderBy('created_at', 'desc')->limit(3);
        // }])->find(auth()->user()->id);
        // return $notif;
        $pegawai = auth()->guard('pegawai')->user();
        $mutasi = Mutasi::where('pegawai_id', $pegawai->id);
        $diklat = Diklat::where('pegawai_id', $pegawai->id)->orderBy('tanggal_sertifikat', 'desc')->first();
        $kenaikanpangkat = KenaikanPangkat::where('pegawai_id', $pegawai->id)->orderBy('tmt_pangkat_dari', 'desc')->first();
        $sip = SIP::where('pegawai_id', $pegawai->id)->orderBy('masa_berakhir_sip', 'desc')->first();
        $str = STR::where('pegawai_id', $pegawai->id)->orderBy('masa_berakhir_str', 'desc')->first();
        return view('pages.dashboard.dashboardpegawai', [
            'pegawai' => $pegawai,
            'KenaikanPangkat' => $kenaikanpangkat,
            'Diklat' => $diklat,
            'Mutasi' => $mutasi,
            'str' => $str,
            'sip' => $sip,
            'dataPegawaiUlangtahun' => $upcomingBirthdays,
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


    public function historyMutasiPegawai()
    {
        
        $pegawai = auth()->guard('pegawai')->user();
        $mutasi = Mutasi::where('pegawai_id', $pegawai->id)->orderBy('tanggal_sk', 'desc')->get();
        return view('pages.mutasi.historypegawai', [
            'pegawai' => $pegawai,
            'mutasi' => $mutasi
        ]);
    }


    public function historyDiklatPegawai()
    {
        $pegawai = auth()->guard('pegawai')->user();
        $diklat = Diklat::where('pegawai_id', $pegawai->id)->orderBy('tanggal_sertifikat', 'desc')->get();
        return view('pages.diklat.diklatpegawai', [
            'pegawai' => $pegawai,
            'diklat' => $diklat
        ]);
    }
    //

    public function historySTRPegawai(){
        $pegawai = auth()->guard('pegawai')->user();
        $str = STR::where('pegawai_id', $pegawai->id)->orderBy('masa_berakhir_str', 'desc')->get();
        return view('pages.str.historypegawai', [
            'pegawai' => $pegawai,
            'str' => $str
        ]);

    }

    public function historySIPPegawai(){
        $pegawai = auth()->guard('pegawai')->user();
        $sip = SIP::where('pegawai_id', $pegawai->id)->orderBy('masa_berakhir_sip', 'desc')->get();
        return view('pages.sip.historypegawai', [
            'pegawai' => $pegawai,
            'sip' => $sip
        ]);
    }

    public function historyCutiPegawai(){
        $pegawai = auth()->guard('pegawai')->user();
        $cuti = CUTI::where('pegawai_id', $pegawai->id)->get();
        return view('pages.cuti.histori-cuti.cutipegawai', [
            'pegawai' => $pegawai,
            'cuti' => $cuti
        ]);
    }
}
