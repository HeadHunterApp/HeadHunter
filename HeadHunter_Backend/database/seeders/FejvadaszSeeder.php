<?php

namespace Database\Seeders;

use App\Models\Fejvadasz;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FejvadaszSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //tesztadatok

        //----FONTOS!!! USER_ID=1 MINDIG AZ ADMIN, MÁS SZÁMOKAT HASZNÁLJATOK!!!----

        Fejvadasz::create([
            'user_id' => 2,
            'telefonszam' => '+36201234567',
        ]);

        
        Fejvadasz::create([
            'user_id' => 5,
            'telefonszam' => '+36201239876',
        ]);
    }
}
