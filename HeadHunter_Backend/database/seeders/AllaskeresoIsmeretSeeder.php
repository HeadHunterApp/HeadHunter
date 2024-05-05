<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AllaskeresoIsmeret; // Importáljuk az AllaskeresoIsmeret modellt

class AllaskeresoIsmeretSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Példa adatok létrehozása és mentése
        AllaskeresoIsmeret::create([
            'allaskereso' => 1,
            'szakmai_ismeret' => 1,
        ]);
        AllaskeresoIsmeret::create([
            'allaskereso' => 2,
            'szakmai_ismeret' => 2,
        ]);
        AllaskeresoIsmeret::create([
            'allaskereso' => 3,
            'szakmai_ismeret' => 3,
        ]);
        AllaskeresoIsmeret::create([
            'allaskereso' => 4,
            'szakmai_ismeret' => 2,
        ]);
        AllaskeresoIsmeret::create([
            'allaskereso' => 5,
            'szakmai_ismeret' => 2,
        ]);
        // További példa adatok hozzáadása...
    }
}
