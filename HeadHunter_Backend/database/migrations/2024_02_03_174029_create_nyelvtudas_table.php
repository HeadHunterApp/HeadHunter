<?php

use App\Models\Nyelvtudas;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    
    public function up(): void
    {
        Schema::create('nyelvtudass', function (Blueprint $table) {
            //$table->primary(['nyelv', 'szint']);  - összetett kulcsok felszámolása
            $table->string('nyelvkod', 4)->primary();
            $table->string('nyelv', 20);
            $table->string('szint', 2);
            //$table->string('megnevezes', 20);
        });
        
    /*   Nyelvtudas::create([
            'nyelvkod' => 'ENA1',
            'nyelv' => 'Angol',
            'szint' => 'A1'
        ]);

        Nyelvtudas::create([
            'nyelvkod' => 'ENA2',
            'nyelv' => 'Angol',
            'szint' => 'A2'
        ]);

        Nyelvtudas::create([
            'nyelvkod' => 'ENB1',
            'nyelv' => 'Angol',
            'szint' => 'B1'
        ]);

        Nyelvtudas::create([
            'nyelvkod' => 'ENB2',
            'nyelv' => 'Angol',
            'szint' => 'B2'
        ]);

        Nyelvtudas::create([
            'nyelvkod' => 'ENC1',
            'nyelv' => 'Angol',
            'szint' => 'C1'
        ]);

        Nyelvtudas::create([
            'nyelvkod' => 'ENC2',
            'nyelv' => 'Angol',
            'szint' => 'C2'
        ]);

        Nyelvtudas::create([
            'nyelvkod' => 'DEA1',
            'nyelv' => 'Német',
            'szint' => 'A1'
        ]);

        Nyelvtudas::create([
            'nyelvkod' => 'DEA2',
            'nyelv' => 'Német',
            'szint' => 'A2'
        ]);

        Nyelvtudas::create([
            'nyelvkod' => 'DEB1',
            'nyelv' => 'Német',
            'szint' => 'B1'
        ]);

        Nyelvtudas::create([
            'nyelvkod' => 'DEB2',
            'nyelv' => 'Német',
            'szint' => 'B2'
        ]);

        Nyelvtudas::create([
            'nyelvkod' => 'DEC1',
            'nyelv' => 'Német',
            'szint' => 'C1'
        ]);

        Nyelvtudas::create([
            'nyelvkod' => 'DEC2',
            'nyelv' => 'Német',
            'szint' => 'C2'
        ]);  */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nyelvtudass');
    }
};
