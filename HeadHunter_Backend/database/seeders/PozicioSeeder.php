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
    }
}
