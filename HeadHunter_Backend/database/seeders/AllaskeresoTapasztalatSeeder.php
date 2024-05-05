<?php

namespace Database\Seeders;

use App\Models\AllaskeresoTapasztalat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllaskeresoTapasztalatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        //tesztadatok

        AllaskeresoTapasztalat::create([
            'allaskereso' => 3,
            'cegnev' => 'Magyar Telekom Nyrt.',
            'ceg_cim' => '1097 Budapest, Könyves Kálmán krt. 36.',
            'pozicio' => 'INFFRO',
            'kezdes' => '2023-01-04',
            'vegzes' => '2024-02-01',
        ]);
        
    }
}
