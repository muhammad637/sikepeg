<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\SIP;
use App\Models\STR;
use App\Models\User;
use App\Models\Admin;
use App\Models\Pangkat;
use App\Models\Pegawai;
use App\Models\Ruangan;
use App\Models\Golongan;
use Illuminate\Database\Seeder;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Admin::create([
            'name' => 'admin',
            'username' => 'admin.1234',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'admin',
        ]);
        Pangkat::create([
            'nama_pangkat' => 'juru muda'
        ]);
        Golongan::create([
            'nama_golongan' => 'doktor linear (gol xi)',
            'jenis' => 'pppk'
        ]);
        Golongan::create([
            'nama_golongan' => 'i a',
            'jenis' => 'pns'
        ]);
        Pegawai::factory(20)->create();
        // STR::factory(40)->create();
        SIP::factory(40)->create();

    }
}
