<?php

namespace App\Console\Commands;

use App\Models\Pegawai;
use Illuminate\Console\Command;

class updateCutiTahunan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:cutiPegawai';

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
        return Command::SUCCESS;
        $pegawai = Pegawai::all();
        foreach ($pegawai as $item) {
            $this->dataUpdate($item);
        }
        $this->info('data berhasil di update');
    }
    private function dataUpdate($pegawai)
    {
        if ($pegawai->tahun_cuti < date('Y') && $pegawai->sisa_cuti_tahunan >= 6) {
            $pegawai->update([
                'sisa_cuti_tahunan' => 18,
            ]);
        }
        if ($pegawai->tahun_cuti < date('Y') && $pegawai->sisa_cuti_tahunan < 6) {
            $pegawai->update([
                'sisa_cuti_tahunan' => $pegawai->sisa_cuti_tahunan + 12,
            ]);
        }
    }
}
