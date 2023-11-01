<?php

namespace Database\Factories;

use App\Models\Pegawai;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pegawai>
 */

class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'nik' => fake()->randomNumber(5, true),
            'nip_nippk' => fake()->randomNumber(5, true),
            'gelar_depan' => fake()->randomLetter(),
            'gelar_belakang' => fake()->randomLetter(),
            'nama_depan' => fake()->name(),
            'nama_belakang' => fake()->name('male'),
            'nama_lengkap' => fake()->name(),
            'jenis_kelamin' => 'laki-laki',
            'tempat_lahir' => 'banyuwangi',
            'tanggal_lahir' => '2001-10-10',
            'usia' => fake()->numberBetween(20, 25),
            'alamat' => fake()->address(),
            'agama' => 'islam',
            'no_wa' => fake()->phoneNumber(),
            'status_pegawai' => 'aktif',
            'ruangan_id' => 1,
            'tahun_pensiun' => '2056',
            'status_tenaga' => 'asn',
            'status_tipe' => 'pppk',
            'pendidikan_terakhir' => 'D4',
            'tanggal_lulus' => '2023-10-10',
            'no_ijazah' => fake()->randomNumber(6, true),
            'jabatan' => fake()->word(),
            'cuti_tahunan' => 12,
            'sisa_cuti_tahunan' => 12,
            'masa_kerja' => 12,
            'tmt_pppk' => '2022-10-10',
            'tmt_pangkat_terakhir' => '2020-10-10',
            'golongan_id' => 1,
            'sekolah' => 'Politeknik Negeri Banyuwangi',
            'jenis_tenaga' => 'nakes',
            'password' => Hash::make('password')
        ];
    }
}
