<?php

namespace Database\Seeders;

use App\Models\Munkaltato;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MunkaltatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //tesztadatok

        Munkaltato::create([
            'cegnev' => 'Kreatív Design Stúdió Kft.',
            'szekhely' => 'Budapest, Kreatív út 12.',
            'kapcsolattarto' => 'Anna Kovács',
            'telefonszam' => '+36301234567',
            'email' => 'info@kreativdesign.hu'
        ]);
        
        Munkaltato::create([
            'cegnev' => 'TechnoLogistic Solutions Zrt.',
            'szekhely' => 'Debrecen, Innovációs park 5.',
            'kapcsolattarto' => 'Péter Nagy',
            'telefonszam' => '+36209876543',
            'email' => 'info@technologisticsolutions.com'
        ]);
        
        Munkaltato::create([
            'cegnev' => 'FoodMaster Élelmiszeripari Kft.',
            'szekhely' => 'Szeged, Ízletes út 8.',
            'kapcsolattarto' => 'Éva Szabó',
            'telefonszam' => '+36705551234',
            'email' => 'eva.szabo@foodmaster.hu'
        ]);
        
        Munkaltato::create([
            'cegnev' => 'HealthyLife Egészségközpont',
            'szekhely' => 'Budapest, Egészség tér 1.',
            'kapcsolattarto' => 'Dr. Gábor Kis',
            'telefonszam' => '+3612345678',
            'email' => 'info@healthylife.hu'
        ]);
        
        Munkaltato::create([
            'cegnev' => 'EcoTech Környezetvédelmi Kft.',
            'szekhely' => 'Szombathely, Zöld utca 20.',
            'kapcsolattarto' => 'Gizella Varga',
            'telefonszam' => '+36709876543',
            'email' => 'info@ecotech.hu'
        ]);
    }
}
