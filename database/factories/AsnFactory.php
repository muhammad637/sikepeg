<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asn>
 */
class AsnFactory extends Factory
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
            'pegawai_id' => rand(1,700),
            'tmt_cpns' => fake()->randomNumber(),
            'tmt_pns' => fake()->randomNumber(),
            'tmt_pangkat_terakhir' => fake()->randomNumber(),
            'pangkat_golongan' => fake()->word(),
            'sekolah' => fake()->words(3, true),
            'jenis_tenaga' => 'nakes',
            // 'jabatan_struktural' => fake()->word(),
        ];
    }
}
