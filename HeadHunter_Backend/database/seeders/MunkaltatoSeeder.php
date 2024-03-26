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
            'cegnev' => 'Valami Kft.', 
            'szekhely' => '1081 Budapest, II. János Pál pápa tér 2.', 
            'kapcsolattarto' => 'Valaki József',
            'telefonszam' => '+36201234567',
            'email' => 'valami@valami.hu'
        ]);
    }
}
