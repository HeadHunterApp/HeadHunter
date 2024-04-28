<?php

namespace Database\Seeders;

use App\Models\Pozicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PozicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        //tesztadatok

        Pozicio::create([
            'pozkod' => 'INFFRO',
            'terulet' => 1,
            'pozicio' => 'frontend fejlesztő'
        ]);

        Pozicio::create([
            'pozkod' => 'INFBCK',
            'terulet' => 1,
            'pozicio' => 'backend fejlesztő'
        ]);

        Pozicio::create([
            'pozkod' => 'INFSEN',
            'terulet' => 1,
            'pozicio' => 'szoftvermérnök'
        ]);

        Pozicio::create([
            'pozkod' => 'INFDSC',
            'terulet' => 1,
            'pozicio' => 'adattudós'
        ]);

        Pozicio::create([
            'pozkod' => 'MARMGR',
            'terulet' => 3,
            'pozicio' => 'marketing manager'
        ]);
        
        Pozicio::create([
            'pozkod' => 'GRFUIX',
            'terulet' => 4,
            'pozicio' => 'UX/UI tervező'
        ]);

        Pozicio::create([
            'pozkod' => 'GYTPEN',
            'terulet' => 5,
            'pozicio' => 'termékmérnök'
        ]);

    }
}
