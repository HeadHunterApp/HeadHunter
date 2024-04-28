<?php

namespace Database\Seeders;

use App\Models\Terulet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeruletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        //tesztadatok

        Terulet::create([
            'megnevezes' => 'Informatika', 
        ]);
        Terulet::create([
            'megnevezes' => 'Értékesítés', 
        ]);
        Terulet::create([
            'megnevezes' => 'Marketing', 
        ]);
        
        Terulet::create([
            'megnevezes' => 'Grafikai tervezés', 
        ]);

        Terulet::create([
            'megnevezes' => 'Gyártás-termelés', 
        ]);
    }
}
