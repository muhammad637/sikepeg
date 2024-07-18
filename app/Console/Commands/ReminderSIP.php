<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Pegawai;
use App\Models\Notifikasi;
use Illuminate\Console\Command;

class ReminderSIP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

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
        $currentDate = Carbon::now();
        $sixMonthsFromNow = $currentDate->addMonths(6);
        $reminderSIP = Pegawai::query()->where('jenis_tenaga', 'nakes')->with(['sip' => function ($query) {
            $query->orderBy('masa_berakhir_sip', 'desc');
        }])->whereHas(
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
        )->get();
        foreach ($reminderSIP as  $employee) {
            $notif = Notifikasi::notif('reminder SIP', $employee->nama_lengkap ?? $employee->nama_depan . 'sip anda akan berakhir pada tanggal'.$employee->sip[0]->masa_berakhir_sip. ' mohon segera perbarui SIP anda ke kepegawaian', 'bg-info', 'fas fa-folder-plus');
            $createNotif = Notifikasi::create($notif);
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($employee->id);
            $upcomingBirthdays[] = $employee;
        }
        return Command::SUCCESS;
    }
}
