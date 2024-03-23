<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Munkaltato>
 */
class MunkaltatoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cegnev' => fake()->name(),
            'szekhely' => fake()->address(),
            'kapcsolattarto' => fake()->name(),
            'telefonszam' => substr(fake()->phoneNumber(), 12),
            'email' => fake()->unique()->email(),
        ];
    }
}
