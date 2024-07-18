<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MutasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Mutasi::create([
            'pegawai_id' => 1,
            'ruangan_awal_id' => 1,
            'ruangan_tujuan_id' => 2,
            'instansi_awal' => 'Instansi Awal',
            'instansi_tujuan' => 'Instansi Tujuan',
            'jenis_mutasi' => 'internal',
            'tanggal_berlaku' => now(),
            'no_sk' => 'No SK',
            'tanggal_sk' => now(),
            'link_sk' => 'Link SK',
        ]);

        \App\Models\Mutasi::create([
            'pegawai_id' => 1,
            'ruangan_awal_id' => 1,
            'ruangan_tujuan_id' => 2,
            'instansi_awal' => 'Instansi Awal',
            'instansi_tujuan' => 'Instansi Tujuan',
            'jenis_mutasi' => 'internal',
            'tanggal_berlaku' => now(),
            'no_sk' => 'No SK',
            'tanggal_sk' => now(),
            'link_sk' => 'Link SK',
        ]);

        \App\Models\Mutasi::create([
            'pegawai_id' => 1,
            'ruangan_awal_id' => 1,
            'ruangan_tujuan_id' => 2,
            'instansi_awal' => 'Instansi Awal',
            'instansi_tujuan' => 'Instansi Tujuan',
            'jenis_mutasi' => 'internal',
            'tanggal_berlaku' => now(),
            'no_sk' => 'No SK',
            'tanggal_sk' => now(),
            'link_sk' => 'Link SK',
        ]);

        \App\Models\Mutasi::create([
            'pegawai_id' => 1,
            'ruangan_awal_id' => 1,
            'ruangan_tujuan_id' => 2,
            'instansi_awal' => 'Instansi Awal',
            'instansi_tujuan' => 'Instansi Tujuan',
            'jenis_mutasi' => 'internal',
            'tanggal_berlaku' => now(),
            'no_sk' => 'No SK',
            'tanggal_sk' => now(),
            'link_sk' => 'Link SK',
        ]);

        \App\Models\Mutasi::create([
            'pegawai_id' => 1,
            'ruangan_awal_id' => 1,
            'ruangan_tujuan_id' => 2,
            'instansi_awal' => 'Instansi Awal',
            'instansi_tujuan' => 'Instansi Tujuan',
            'jenis_mutasi' => 'internal',
            'tanggal_berlaku' => now(),
            'no_sk' => 'No SK',
            'tanggal_sk' => now(),
            'link_sk' => 'Link SK',
        ]);
    }
}
