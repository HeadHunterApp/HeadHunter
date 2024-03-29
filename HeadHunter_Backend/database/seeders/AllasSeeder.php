<?php

namespace Database\Seeders;

use App\Models\Allas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        //tesztadatok

        Allas::create([
            'munkaltato' => 1,
            'megnevezes' => 'szoftver fejlesztő',
            'pozicio' => 'INFFRO',
            'statusz' => 'nyitott',
            'leiras' => 'Applikáció fejlesztőként feladatod lesz cégünk jelenlegi, React Native nyelven írt iOS, illetve.',
            'datum' => '2024-03-20',
            'fejvadasz' => 2,
        ]);
    }
}
