<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AllasIsmeret;

class AllasIsmeretSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Példa adatok hozzáadása
        AllasIsmeret::create([
            'allas' => 4,
            'szakmai_ismeret' => 1,
            'elvaras_szint' => 'kezdo',
        ]);

        AllasIsmeret::create([
            'allas' => 5,
            'szakmai_ismeret' => 2,
            'elvaras_szint' => 'kezdo',
        ]);
        

        // További adatok hozzáadása szükség szerint

    }
}
