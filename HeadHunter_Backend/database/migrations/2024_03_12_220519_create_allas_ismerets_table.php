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
        Schema::create('allas_ismerets', function (Blueprint $table) {
            $table->foreignId('allas')->references('allas_id')->on('allass');
            $table->foreignId('szakmai_ismeret')->references('ismeret_id')->on('szakmai_ismerets');
            $table->primary(['allas','szakmai_ismeret']);
            $table->string('elvaras_szint', 15);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allas_ismerets');
    }
};
