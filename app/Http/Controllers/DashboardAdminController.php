<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SIP;
use App\Models\STR;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardAdminController extends Controller
{
    //
    public function index()
    {
        // Mendefinisikan tanggal hari ini
        $today = Carbon::today();
        // $today = now();

        $endDate = $today->copy()->addDay(7);
        // Mendefinisikan tanggal 6 bulan dari sekarang
        $sixMonthsFromNow = $today->addMonths(6);

        // Query untuk mengambil STR yang sudah kadaluarsa atau akan kadaluarsa dalam 6 bulan
        $reminderSTR = STR::where(function ($query) use ($today, $sixMonthsFromNow) {

            // Subquery 1: Mengambil STR yang sudah kadaluarsa
            $query->where('masa_berakhir_str', '<', $today);

            // Subquery 2: Mengambil STR yang akan kadaluarsa dalam 6 bulan
            $query->orWhere(function ($query) use ($today, $sixMonthsFromNow) {
                $query->where('masa_berakhir_str', '>=', $today)
                    ->where('masa_berakhir_str', '<=', $sixMonthsFromNow);
            });

            // menjumlahkan str pegawai yang kadaluarsa
        })->groupBy('pegawai_id')->count();

        // Query untuk mengambil SIP yang sudah kadaluarsa atau akan kadaluarsa dalam 6 bulan
        $reminderSIP = SIP::where(function ($query) use ($today, $sixMonthsFromNow) {

            // Subquery 1: Mengambil STR yang sudah kadaluarsa
            $query->where('masa_berakhir_sip', '<', $today)

                // Subquery 2: Mengambil SIP yang akan kadaluarsa dalam 6 bulan
                ->orWhere(function ($query) use ($today, $sixMonthsFromNow) {
                    $query->where('masa_berakhir_sip', '>=', $today)
                        ->where('masa_berakhir_sip', '<=', $sixMonthsFromNow);
                });
                
            // menjumlahkan SIP pegawai yang kadaluarsa
        })->groupBy('pegawai_id')->count();
        $reminderUlangTahun = Pegawai::
        where('tahun_pensiun' ,'>', now())
        ->where('status_pegawai','aktif')
            ->whereDay('tanggal_lahir','>=',$today->day)
            ->orWhereDay('tanggal_lahir', '<=', $endDate->day)
            ->whereMonth('tanggal_lahir', '=', $today->month)
            ->orderByRaw("CONVERT(SUBSTRING(tanggal_lahir, 6, 2), SIGNED) ASC, CONVERT(SUBSTRING(tanggal_lahir, 8, 2), SIGNED) ASC")
        ->get();
        // Menampilkan hasil ke tampilan
        return view(
            'pages.dashboard.index',
            [
                'reminderSTR' => $reminderSTR,
                'reminderSIP' => $reminderSIP,
                'dataPegawaiUlangtahun' => $reminderUlangTahun
            ]
        );
    }
}
