<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //tesztadatok

        User::create([
            'nev' => 'Minta-Fejvadász András', 
            'email' => 'a.minta-fejv@headhunter.com', 
            'password' => 'Newpass123',
            'jogosultsag' => 'fejvadász',
        ]);

        User::create([
            'nev' => 'Példa-Álláskereső Lilla', 
            'email' => 'lilla-pallker@gmail.com', 
            'password' => 'Jelszo123',
            'jogosultsag' => 'álláskereső',
        ]);

        User::create([
            'nev' => 'Holameló Béla', 
            'email' => 'bela-the-king@freemail.hu', 
            'password' => 'Almafa123',
            'jogosultsag' => 'álláskereső',
        ]);

        User::create([
            'nev' => 'Beoszt Tivadar', 
            'email' => 't.beoszt@headhunter.com', 
            'password' => 'Newpass123',
            'jogosultsag' => 'fejvadász',
        ]);
        User::create([
            'nev' => 'Huba István', 
            'email' => 'huba@headhunter.com', 
            'password' => 'Huba123.',
            'jogosultsag' => 'fejvadász',
        ]);
    }
}
