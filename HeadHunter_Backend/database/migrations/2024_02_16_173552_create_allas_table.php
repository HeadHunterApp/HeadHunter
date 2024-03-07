<?php

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
        Schema::create('allas', function (Blueprint $table) {
            $table->id('allas_id');
            $table->foreignId('munkaltato')->references('munkaltato_id')->on('munkaltatos');
            $table->string('megnevezes', 30);
            $table->string('terulet');
            $table->string('pozicio', 20);
            //$table->foreign('terulet')->references('megnevezes')->on('terulet');
            $table->foreign(['terulet', 'pozicio'])->references(['terulet', 'pozicio'])->on('pozicios');
            $table->string('statusz', 40);
            $table->longText('leiras');
            $table->date('datum');
            //inkább timestamp kéne, és abból kellene a dátum részt kiszedni
            $table->foreignId('fejvadasz')->references('user_id')->on('fejvadaszs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allas');
    }
};
