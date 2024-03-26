<?php

namespace Database\Seeders;

use App\Models\AllasVegzettseg;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllasVegzettsegSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         
        //tesztadatok

        AllasVegzettseg::create([
            'allas' => 1,
            'vegzettseg' => 3,
        ]);
    }
}
