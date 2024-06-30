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
            'nik' => $this->faker->randomNumber(5, true),
            'nip_nippk' => $this->faker->randomNumber(5, true),
            'gelar_depan' => $this->faker->randomLetter(),
            'gelar_belakang' => $this->faker->randomLetter(),
            'nama_depan' => $this->faker->firstName(),
            'nama_belakang' => $this->faker->lastName(),
            'nama_lengkap' => $this->faker->name(),
            'jenis_kelamin' => 'laki-laki',
            'tempat_lahir' => 'banyuwangi',
            'tanggal_lahir' => $this->faker->date('Y-m-d', '2001-01-01'),
            'usia' => $this->faker->numberBetween(20, 25),
            'alamat' => $this->faker->address(),
            'agama' => 'islam',
            'no_wa' => $this->faker->phoneNumber(),
            'status_pegawai' => 'aktif',
            'ruangan_id' => 1,
            'tahun_pensiun' => '2056',
            'status_tenaga' => 'asn',
            'status_tipe' => 'pppk',
            'pendidikan_terakhir' => 'D4',
            'tanggal_lulus' => $this->faker->date('Y-m-d', '2023-01-01'),
            'no_ijazah' => $this->faker->randomNumber(6, true),
            'jabatan' => $this->faker->word(),
            'cuti_tahunan' => 12,
            'sisa_cuti_tahunan' => 12,
            'masa_kerja' => 12,
            'tmt_pppk' => $this->faker->date('Y-m-d', '2022-01-01'),
            'tmt_pangkat_terakhir' => now()->format('Y-m-d'),
            'sekolah' => 'Politeknik Negeri Banyuwangi',
            'jenis_tenaga' => 'nakes',
            'password' => Hash::make('password'),
            'pangkat_golongan_id' => 1
        ];
    }
}
