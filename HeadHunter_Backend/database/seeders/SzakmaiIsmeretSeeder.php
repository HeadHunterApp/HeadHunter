<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SzakmaiIsmeret; 


class SzakmaiIsmeretSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $szakmaiIsmeretek = [
            ['megnevezes' => 'Webfejlesztés', 'szint' => 'Középhaladó'],
            ['megnevezes' => 'Adatbázis tervezés', 'szint' => 'Haladó'],
            ['megnevezes' => 'Projektmenedzsment', 'szint' => 'Haladó'],
            ['megnevezes' => 'Grafikai tervezés', 'szint' => 'Kezdő'],
            ['megnevezes' => 'Mobilalkalmazás fejlesztés', 'szint' => 'Haladó'],
            ['megnevezes' => 'Tesztelés', 'szint' => 'Középhaladó'],
            ['megnevezes' => 'UI/UX design', 'szint' => 'Haladó'],
            ['megnevezes' => 'Hálózati ismeretek', 'szint' => 'Középhaladó'],
            ['megnevezes' => 'Operációs rendszerek ismerete', 'szint' => 'Haladó'],
            ['megnevezes' => 'Felhasználói felület tervezés', 'szint' => 'Kezdő'],
            ['megnevezes' => 'Kommunikáció', 'szint' => 'Kiváló'],
            ['megnevezes' => 'Problémamegoldás', 'szint' => 'Haladó'],
            ['megnevezes' => 'Időmenedzsment', 'szint' => 'Kiváló'],
            ['megnevezes' => 'Csapatmunka', 'szint' => 'Haladó'],
            ['megnevezes' => 'Kreativitás', 'szint' => 'Kiváló'],
            ['megnevezes' => 'Empátia', 'szint' => 'Haladó'],
            ['megnevezes' => 'Rugalmas gondolkodás', 'szint' => 'Kiváló'],
            ['megnevezes' => 'Stresszkezelés', 'szint' => 'Haladó'],
            ['megnevezes' => 'Érdekérvényesítés', 'szint' => 'Kiváló'],
            ['megnevezes' => 'Konfliktuskezelés', 'szint' => 'Haladó'],
        ];

        foreach ($szakmaiIsmeretek as $ismeret) {
            SzakmaiIsmeret::create($ismeret);
        }

        

    }
}
