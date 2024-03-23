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
        Schema::create('allas_nyelvtudass', function (Blueprint $table) {
            $table->foreignId('allas')->references('allas_id')->on('allass');
            $table->string('nyelvtudas', 4);
            $table->foreign('nyelvtudas')->references('nyelvkod')->on('nyelvtudass');
            $table->primary(['allas','nyelvtudas']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allas_nyelvtudass');
    }
};
