<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('update:cutiPegawai')->dailyAt('10:00'); // Menjadwalkan setiap tahun pada tanggal 1 Januari
        // $schedule->command('update:cutiPegawai')->yearlyOn(1, 1); // Menjadwalkan setiap tahun pada tanggal 1 Januari
        // $schedule->command('inspire')->hourly();
        // $schedule->command('cuti:pegawai')->dailyAt('03:00');
        // $schedule->command('reminder:ulangtahun')->dailyAt('03:00');
        // $schedule->command('cuti:pegawai')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
