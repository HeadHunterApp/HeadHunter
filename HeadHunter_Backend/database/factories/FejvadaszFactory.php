<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fejvadasz>
 */
class FejvadaszFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'telefonszam'=> substr(fake()->phoneNumber(), 12),
            'fenykep' => fake()->imageUrl(),
            'user_id' => 1,
        ];
    }
}
