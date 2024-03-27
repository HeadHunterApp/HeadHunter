<?php

namespace Database\Seeders;

use App\Models\Allaskereso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllaskeresoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //tesztadatok

        //----FONTOS!!! USER_ID=1 MINDIG AZ ADMIN, MÁS SZÁMOKAT HASZNÁLJATOK!!!----

        Allaskereso::create([
            'user_id' => 3,
            'nem' => 'nő',
            'szul_ido' => '1999/09/09',
            'telefonszam' => '+36301234567',
            'fax' => '+361123456',
            'allampolgarsag' => 'magyar',
            'jogositvany' => false,
            'szoc_keszseg' => 'jó kommunikációs készség, kiváló munka csapatban és önállóan egyeránt',
        ]);

        Allaskereso::create([
            'user_id' => 4,
            'nem' => 'férfi',
            'szul_ido' => '2002/02/02',
            'telefonszam' => '+36709876543',
            'fax' => '',
            'allampolgarsag' => 'magyar',
            'jogositvany' => true,
            'szoc_keszseg' => 'úgy gondolom, jó velem együtt dolgozni',
        ]);
    }
}
