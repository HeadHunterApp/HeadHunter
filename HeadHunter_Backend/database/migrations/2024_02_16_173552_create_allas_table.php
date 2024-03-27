<?php

use App\Models\Allas;
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
        Schema::create('allass', function (Blueprint $table) {
            $table->id('allas_id');
            $table->foreignId('munkaltato')->references('munkaltato_id')->on('munkaltatos');
            $table->string('megnevezes', 30);
            $table->string('pozicio', 6);
            $table->foreign('pozicio')->references('pozkod')->on('pozicios');
            //$table->foreign(['terulet', 'pozicio'])->references(['terulet', 'pozicio'])->on('pozicios'); - összetett kulcsok felszámolása
            $table->string('statusz', 40);
            $table->longText('leiras');
            $table->date('datum');
            $table->foreignId('fejvadasz')->references('user_id')->on('fejvadaszs')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allass');
    }
};
