<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\STR>
 */
class STRFactory extends Factory
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
            'pegawai_id' => rand(1, 10),
            'no_str' => fake()->randomNumber(),
            'no_sertikom' => fake()->randomNumber(),
            'kompetensi' => 'Ahli Madya Kebinanan',
            'tanggal_terbit_str' => fake()->dateTimeBetween('-1 week', '+1 week'),
            'masa_berakhir_str' => fake()->dateTimeThisDecade('+2 years'),
            'link_str' => 'hello world',
        ];
    }
}
