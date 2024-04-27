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
            'password' => 'newpass123',
            'jogosultsag' => 'fejvadasz',
        ]);

        User::create([
            'nev' => 'Példa-Álláskereső Lilla', 
            'email' => 'lilla-pallker@gmail.com', 
            'password' => 'jelszo123',
            'jogosultsag' => 'allaskereso',
        ]);

        User::create([
            'nev' => 'Holameló Béla', 
            'email' => 'bela-the-king@freemail.hu', 
            'password' => 'almafa',
            'jogosultsag' => 'allaskereso',
        ]);

        User::create([
            'nev' => 'Beoszt Tivadar', 
            'email' => 't.beoszt@headhunter.com', 
            'password' => 'newpass123',
            'jogosultsag' => 'fejvadasz',
        ]);
    }
}
