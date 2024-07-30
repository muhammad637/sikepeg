<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Pegawai::create([
            'nik' => '123456',
            'nip_nippk' => '1234567890',
            'gelar_depan' => 'Dr.',
            'gelar_belakang' => 'S.Kom.',
            'nama_depan' => 'John',
            'nama_belakang' => 'Doe',
            'nama_lengkap' => 'John Doe',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'alamat' => 'Jl. Sudirman No. 1',
            'usia' => '30',
            'agama' => 'Islam',
            'no_wa' => '081234567890',
            'status_pegawai' => 'Aktif',
            'ruangan_id' => 1,
            'tahun_pensiun' => '2050',
            'pendidikan_terakhir' => 'S2',
            'tanggal_lulus' => '2015-01-01',
            'no_ijazah' => '1234567890',
            'jabatan' => 'Kepala Bagian',
            'cuti_tahunan' => 12,
            'tahun_cuti' => date('Y'),
            'sisa_cuti_tahunan' => 12,
            'masa_kerja' => '10 Tahun',
            'status_tenaga' => 'asn',
            'status_tipe' => 'pns',
            'tmt_cpns' => '2010-01-01',
            'tmt_pns' => '2010-01-01',
            'tmt_pppk' => '2010-01-01',
            'tmt_pangkat_terakhir' => '2010-01-01',
            'pangkat_golongan_id' => 1,
            'sekolah' => 'Universitas Indonesia',
            'jenis_tenaga' => 'struktural',
            'no_karpeg' => '1234567890',
            'no_taspen' => '1234567890',
            'no_npwp' => '1234567890',
            'no_hp' => '081234567890',
            'email' => 'johndoe@example.com',
            'pelatihan' => 'Pelatihan A',
            'password' => bcrypt('password'),
            'status_nonaktif' => 'Aktif',
        ]);
    }
}
