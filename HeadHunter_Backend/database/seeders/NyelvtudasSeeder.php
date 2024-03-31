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
            'nyelvkod' => 'DEA2',
            'nyelv' => 'német',
            'szint' => 'A2',
            'megnevezes' => 'alapszint',
        ]);

        Nyelvtudas::create([
            'nyelvkod' => 'DEB2',
            'nyelv' => 'német',
            'szint' => 'B2',
            'megnevezes' => 'társalgási szint',
        ]);

        Nyelvtudas::create([
            'nyelvkod' => 'ENB2',
            'nyelv' => 'angol',
            'szint' => 'B2',
            'megnevezes' => 'társalgási szint',
        ]);
    }
}
