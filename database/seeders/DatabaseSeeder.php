<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\SIP;
use App\Models\STR;
use App\Models\Cuti;
use App\Models\User;
use App\Models\Admin;
use App\Models\Pangkat;
use App\Models\Pegawai;
use App\Models\Ruangan;
use App\Models\Golongan;
use App\Models\PangkatGolongan;
use Illuminate\Database\Seeder;
use Database\Seeders\MutasiSeeder;
use Database\Factories\PegawaiNakesFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      

       
        // Ruangan::create([
        //     'nama_ruangan' => 'admin',
        // ]);
        // Ruangan::create([
        //     'nama_ruangan' => 'GKT',
        // ]);
       
        // PangkatGolongan::factory(5)->create();
        // Pegawai::factory(20)->create();
        // STR::factory(40)->create();
        // SIP::factory(40)->create();
        // $this->call(MutasiSeeder::class);

        Cuti::factory(1000)->create();

    }
}
