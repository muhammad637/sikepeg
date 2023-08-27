<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SIP>
 */
class SIPFactory extends Factory
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
            'asn_id' => rand(1, 10),
            'no_sip' => fake()->randomNumber(),
            'tanggal_terbit_sip' => fake()->dateTimeBetween('-1 week', '+1 week'),
            'masa_berlaku_sip' => fake()->dateTimeThisDecade('+2 years'),
            'link_sip' => 'hello world',
        ];
    }
}
