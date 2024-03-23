<?php

namespace Database\Factories;

use App\Models\Nyelvtudas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nyelvtudas>
 */
class NyelvtudasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
/*             'nyelvkod' => Nyelvtudas::NYELVKOD[array_rand(Nyelvtudas::NYELVKOD)],
            'nyelv' => substr(fake()->word(),20),
            'szint' => substr(fake()->word(),20),
            'megnevezes' => substr(fake()->word(),20), */
        ];
    }
}
