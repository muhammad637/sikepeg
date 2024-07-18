<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PangkatGolongan>
 */
class PangkatGolonganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $testing = ['pns','pppk'];
    public function definition()
    {
        return [
            //
            'nama' => 'testing/'.rand(1,10),
            'nama_kecil' => 'testing/'.rand(1,10),
            'jenis' => $this->testing[array_rand($this->testing)]
        ];
    }
}
