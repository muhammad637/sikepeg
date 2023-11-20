<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SIP;
use App\Models\STR;
use App\Models\Admin;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    //
    
    public function index()
    {
        $currentDate = Carbon::now();
        $sixMonthsFromNow = $currentDate->addMonths(6);
        $reminderSTR = Pegawai::with('str')->whereHas(
            'str',
            function ($query) use ($currentDate, $sixMonthsFromNow) {
                $query->whereDate(
                    'tanggal_terbit_str',
                    '<=',
                    $currentDate
                )
                    ->whereDate('masa_berakhir_str', '>', $currentDate)
                    ->whereDate('masa_berakhir_str', '>', $sixMonthsFromNow);
            },
            '=',
            0
        )->count();

        $reminderSIP = Pegawai::with('sip')->whereHas(
            'sip',
            function ($query) use ($currentDate, $sixMonthsFromNow) {
                $query->whereDate(
                    'tanggal_terbit_sip',
                    '<=',
                    $currentDate
                )
                    ->whereDate('masa_berakhir_sip', '>', $currentDate)
                    ->whereDate('masa_berakhir_sip', '>', $sixMonthsFromNow);
            },
            '=',
            0
        )->count();

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

        // return $upcomingBirthdays;
        $pegawai = Pegawai::select('status_pegawai', DB::raw("COUNT(id) as count"))->groupBy('status_pegawai')->get();
        $pegawais = Pegawai::select('status_tipe', DB::raw("COUNT(id) as count"))
        ->groupBy('status_tipe')
        ->get();
        // return $reminderSTR;
        return view(
            'pages.dashboard.index',
            [
                'reminderSTR' => $reminderSTR,
                'reminderSIP' => $reminderSIP,
                'dataPegawaiUlangtahun' => $upcomingBirthdays,
                'pegawais' => $pegawais,
                'pegawai' => $pegawai,

            ]
        );
   
    }
    public function statusTenagaChart()
    {
        $pegawai = Pegawai::select('status_pegawai', DB::raw("COUNT(id) as count"))->groupBy('status_pegawai')->get();
       

        $pegawais = Pegawai::select('status_tipe',DB::raw("COUNT(id) as count"))
                    ->groupBy('status_tipe')
                    ->get();
 
        return view('pages.dashboard.index',compact('pegawais', 'pegawai'));
    }

}
