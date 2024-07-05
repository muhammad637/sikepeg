<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cuti>
 */
class CutiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'pegawai_id' => 1,
            // 'pegawai_id' => $this->faker->numberBetween(1, 10),
            'jenis_cuti' => $this->faker->randomElement(['Cuti Tahunan', 'Cuti Sakit', 'Cuti Melahirkan']),
            'alasan_cuti' => $this->faker->sentence,
            'mulai_cuti' => $this->faker->date,
            'selesai_cuti' => $this->faker->date,
            'no_hp' => $this->faker->phoneNumber,
            'alamat' => $this->faker->address,
            'jumlah_hari' => $this->faker->numberBetween(1, 30),
            'link_cuti' => $this->faker->url,
        ];
    }
}
