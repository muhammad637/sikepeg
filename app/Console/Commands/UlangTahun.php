<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Pegawai;
use App\Models\Notifikasi;
use Illuminate\Console\Command;

class UlangTahun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:ulangtahun';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::now(); // Mengambil tanggal dan waktu saat ini
        // $nextWeek = $today->copy()->addDays(7); // Menambahkan 7 hari ke tanggal saat ini
        $employees = Pegawai::all(); // Mengambil semua pegawai (gantilah ini dengan query yang sesuai ke database)
        $upcomingBirthdays = [];
        foreach ($employees as $employee) {
            $birthdate = Carbon::createFromFormat('Y-m-d', $employee->tanggal_lahir);
            $birthdayThisYear = $birthdate->copy()->year($today->year); // Mengatur tahun ulang tahun sesuai dengan tahun saat ini
            // $birthdayNextYear = $birthdate->copy()->year($today->year + 1); // Mengatur tahun ulang tahun sesuai dengan tahun depan
            if ($today->isSameDay($birthdayThisYear)) {
                $notif = Notifikasi::notif('ulang tahun', $employee->nama_lengkap ?? $employee->nama_depan. ' berulang tahun pada tanggal '.$birthdate->format('d-m-Y') , 'bg-info', 'fa-solid fa-cake-candles');
                $createNotif = Notifikasi::create($notif);
                $createNotif->admin()->sync(Admin::adminId());
                $createNotif->pegawai()->sync(Pegawai::pegawaiId());
                $upcomingBirthdays[] = $employee;
            }
        }
        return Command::SUCCESS;
    }
}
