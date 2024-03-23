<?php

namespace Database\Factories;

use App\Models\Allaskereso;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Allaskereso>
 */
class AllaskeresoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nem' => Allaskereso::NEMEK[rand(0,1)],
            'szul_ido' => fake()->date(),
            'telefonszam'=> substr(fake()->phoneNumber(), 12),
            'fax' => substr(fake()->phoneNumber(), 12),
            'user_id' => 1,
            // 'allampolgarsag' => substr(fake()->text(), 20),
            'jogositvany' => rand(0, 1),
            'szoc_keszseg'=>fake()->text(),
        ];
    }
}
