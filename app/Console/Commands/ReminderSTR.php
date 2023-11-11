<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Pegawai;
use App\Models\Notifikasi;
use Illuminate\Console\Command;

class ReminderSTR extends Command
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
        $reminderstr = Pegawai::query()->where('jenis_tenaga', 'nakes')->with(['str' => function ($query) {
            $query->orderBy('masa_berakhir_str', 'desc');
        }])->whereHas(
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
        )->get();
        foreach ($reminderstr as  $employee) {
            $notif = Notifikasi::notif('reminder str', $employee->nama_lengkap ?? $employee->nama_depan . 'str anda akan berakhir pada tanggal' . $employee->str[0]->masa_berakhir_str . ' mohon segera perbarui str anda ke kepegawaian', 'bg-info', 'fas fa-folder-plus');
            $createNotif = Notifikasi::create($notif);
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($employee->id);
            $upcomingBirthdays[] = $employee;
        }
        return Command::SUCCESS;
    }
}
