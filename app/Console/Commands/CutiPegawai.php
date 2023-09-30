<?php

namespace App\Console\Commands;

use App\Models\Cuti;
use App\Models\Pegawai;
use Illuminate\Console\Command;

class CutiPegawai extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cuti:pegawai';

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
        // Ambil semua cuti yang sudah selesai
        $cutiSelesai = Cuti::where('status', 'aktif')
            ->whereDate('selesai_cuti', '<', now())
            ->get();
        $cutiMulai = Cuti::where('status', 'pending')->get();
        foreach ($cutiSelesai as $cuti) {
            $cuti->update(['status' => 'nonaktif']);
            $cuti->pegawai->update(['status' => 'aktif']);
        }
        foreach ($cutiMulai as $cuti) {
            $cuti->update(['status' => 'nonaktif']);
            $cuti->pegawai->update(['status' => 'aktif']);
        }
        return Command::SUCCESS;
    }
}
