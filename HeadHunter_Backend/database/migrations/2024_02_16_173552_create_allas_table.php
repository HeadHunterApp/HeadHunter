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
            $table->id('allas_ID');
            $table->foreignId('munkaltato')->references('munkaltato_ID')->on('munkaltatos');
            $table->string('megnevezes', 30);
            $table->primary('terulet', 'pozicio');
            $table->foreignId('terulet')->references('megnevezes')->on('terulets');
            $table->foreignId('pozicio')->references('pozicio')->on('pozicios');
            $table->string('statusz', 40);
            $table->longText('leiras');
            $table->date('datum');
            $table->foreignId('fejvadasz')->references('user_ID')->on('fejvadaszs');
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
