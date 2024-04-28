<?php

namespace Database\Seeders;

use App\Models\Nyelvtudas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NyelvtudasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*szintek és megnevezések:
            A1 - minimum szint
            A2 - alapszint
            B1 - küszöbszint - ez az első három maradjon az eredeti megnevezésével
            B2 - középszint - ez a társalgási szint
            C1 - haladó szint - ez a tárgyalóképes szint
            C2 - mesterfok - ez az anyanyelvi szint
        */


        //tesztadatok
        
        Nyelvtudas::create([
            'nyelvkod' => 'ENA1',
            'nyelv' => 'Angol',
            'szint' => 'A1'
        ]);

        Nyelvtudas::create([
            'nyelvkod' => 'ENA2',
            'nyelv' => 'Angol',
            'szint' => 'A2'
        ]);

        Nyelvtudas::create([
            'nyelvkod' => 'ENB1',
            'nyelv' => 'Angol',
            'szint' => 'B1'
        ]);

        Nyelvtudas::create([
            'nyelvkod' => 'ENB2',
            'nyelv' => 'Angol',
            'szint' => 'B2'
        ]);

        Nyelvtudas::create([
            'nyelvkod' => 'ENC1',
            'nyelv' => 'Angol',
            'szint' => 'C1'
        ]);

        Nyelvtudas::create([
            'nyelvkod' => 'ENC2',
            'nyelv' => 'Angol',
            'szint' => 'C2'
        ]);

        Nyelvtudas::create([
            'nyelvkod' => 'DEA1',
            'nyelv' => 'Német',
            'szint' => 'A1'
        ]);

        Nyelvtudas::create([
            'nyelvkod' => 'DEA2',
            'nyelv' => 'Német',
            'szint' => 'A2'
        ]);

        Nyelvtudas::create([
            'nyelvkod' => 'DEB1',
            'nyelv' => 'Német',
            'szint' => 'B1'
        ]);

        Nyelvtudas::create([
            'nyelvkod' => 'DEB2',
            'nyelv' => 'Német',
            'szint' => 'B2'
        ]);

        Nyelvtudas::create([
            'nyelvkod' => 'DEC1',
            'nyelv' => 'Német',
            'szint' => 'C1'
        ]);

        Nyelvtudas::create([
            'nyelvkod' => 'DEC2',
            'nyelv' => 'Német',
            'szint' => 'C2'
        ]);

    }
}
