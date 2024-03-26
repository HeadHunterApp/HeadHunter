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
            $table->string('megnevezes', 20);
        });
        
        /*szintek és megnevezések:
            A1 - minimum szint
            A2 - alapszint
            B1 - küszöbszint - ez az első három maradjon az eredeti megnevezésével
            B2 - középszint - ez a társalgási szint
            C1 - haladó szint - ez a tárgyalóképes szint
            C2 - mesterfok - ez az anyanyelvi szint
        */


        //tesztadatok

        Nyelvtudas::create([
            'nyelvkod' => 'DEA2',
            'nyelv' => 'német',
            'szint' => 'A2',
            'megnevezes' => 'alapszint',
        ]);

        Nyelvtudas::create([
            'nyelvkod' => 'DEB2',
            'nyelv' => 'német',
            'szint' => 'B2',
            'megnevezes' => 'társalgási szint',
        ]);

        Nyelvtudas::create([
            'nyelvkod' => 'ENB2',
            'nyelv' => 'angol',
            'szint' => 'B2',
            'megnevezes' => 'társalgási szint',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nyelvtudass');
    }
};
