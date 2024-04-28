<?php

namespace Database\Seeders;

use App\Models\AllaskeresoTanulmany;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllaskeresoTanulmanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        //tesztadatok

        AllaskeresoTanulmany::create([
            'allaskereso' => 3,
            'intezmeny' => 'Budapesti Műszaki és Gazdaságtudományi Egyetem',
            'szak' => 'Mérnökinformatikus',
            'vegzettseg' => 5,
            'kezdes' => '2019-09-01',
            'vegzes' => '2023-07-01',
            'erintett_targytev' => 'HTML, CSS, Javascript, JQuery, REACT, C#',
        ]);
    }
}
