<?php

namespace Database\Factories;

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
            'nik' => fake()->randomNumber(5, true),
            'nip_nippk' => fake()->randomNumber(5, true),
            'gelar_depan' => fake()->randomLetter(),
            'gelar_belakang' => fake()->randomLetter(),
            'nama_depan' => fake()->name(),
            'nama_belakang' => fake()->name('male'),
            'jenis_kelamin' => 'laki-laki',
            'tempat_lahir' => 'banyuwangi',
            'tanggal_lahir' => '2001-10-10',
            'usia' => fake()->numberBetween(20, 25),
            'alamat' => fake()->address(),
            'agama' => 'islam',
            'no_wa' => fake()->phoneNumber(),
            'status_pegawai' => 'aktif',
            'ruangan' => fake()->word(),
            'tahun_pensiun' => '2056',
            'status_tenaga' => 'asn',
            'status_tipe' => 'pns',
            'pendidikan_terakhir' => 'D4',
            'tanggal_lulus' => '2023-10-10',
            'no_ijazah' => fake()->randomNumber(6, true),
            'jabatan' => fake()->word(),
            'cuti_tahunan' => 12,
            'sisa_cuti_tahunan' => 12,
            'masa_kerja' => 12,
             // asn
             'tmt_cpns' => '2020-10-10',
             'tmt_cpns' => '2020-10-10',
             'tmt_pangkat_terakhir' => '2020-10-10',
             'pangkat_golongan' => fake()->userName(),
             'sekolah' => 'Politeknik Negeri Banyuwangi',
             'jenis_tenaga' => 'nakes',
            //  non asn
            //  'niPtt_pkThl',
            //  'tanggal_masuk',
            // //  asn umum
            //  'no_karpeg',
            //  'no_taspen',
            //  'no_npwp',
            //  'no_hp',
            //  'email',
            //  'pelatihan',
        ];
    }
}
