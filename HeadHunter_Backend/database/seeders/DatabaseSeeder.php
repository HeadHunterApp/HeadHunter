<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
         \App\Models\User::factory(10)->create();
         \App\Models\Allaskereso::factory(10)->create();
         \App\Models\Fejvadasz::factory(10)->create();
         \App\Models\Munkaltato::factory(10)->create();
         \App\Models\Nyelvtudas::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);*/

        $this->call(UserSeeder::class);
        $this->call(AllaskeresoSeeder::class);
        $this->call(FejvadaszSeeder::class);
        $this->call(MunkaltatoSeeder::class);
        $this->call(NyelvtudasSeeder::class);
        $this->call(SzakmaiIsmeretSeeder::class);
        $this->call(TapasztalatIdoSeeder::class);
        $this->call(TeruletSeeder::class);
        $this->call(VegzettsegSeeder::class);
        $this->call(PozicioSeeder::class);
        $this->call(FejvadaszTeruletSeeder::class);
        $this->call(AllasSeeder::class);
        $this->call(AllasIsmeretSeeder::class);
        $this->call(AllasVegzettsegSeeder::class);
        $this->call(AllasNyelvtudasSeeder::class);
        $this->call(AllasTapasztalatSeeder::class);
        $this->call(AllaskeresoIsmeretSeeder::class);
        $this->call(AllaskeresoNyelvtudasSeeder::class);
        $this->call(AllaskeresoTapasztalatSeeder::class);
        $this->call(AllaskeresoTanulmanySeeder::class);
        $this->call(AllasJelentkezoSeeder::class);
    }
}
