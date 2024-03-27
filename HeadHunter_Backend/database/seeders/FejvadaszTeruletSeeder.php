<?php

namespace Database\Seeders;

use App\Models\FejvadaszTerulet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FejvadaszTeruletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        //tesztadatok

        FejvadaszTerulet::create([
            'fejvadasz' => 2,
            'terulet' => 1,
        ]);
    }
}
