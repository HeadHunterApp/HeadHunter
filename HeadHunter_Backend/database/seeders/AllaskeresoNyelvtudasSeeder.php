<?php

namespace Database\Seeders;

use App\Models\AllaskeresoNyelvtudas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllaskeresoNyelvtudasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        //tesztadatok

        AllaskeresoNyelvtudas::create([
            'allaskereso' => 3,
            'nyelvtudas' => 'ENB2',
            'nyelvvizsga' => true,
            'iras' => 'B2',
            'olvasas' => 'B2',
            'beszed' => 'B2',
        ]);

        AllaskeresoNyelvtudas::create([
            'allaskereso' => 3,
            'nyelvtudas' => 'DEB2',
            'nyelvvizsga' => false,
            'iras' => 'középszint',
            'olvasas' => 'középszint',
            'beszed' => 'alapszint',
        ]);

        AllaskeresoNyelvtudas::create([
            'allaskereso' => 4,
            'nyelvtudas' => 'DEA2',
            'nyelvvizsga' => false,
            'iras' => 'alapszint',
            'olvasas' => 'alapszint',
            'beszed' => 'középszint',
        ]);
    }
}
