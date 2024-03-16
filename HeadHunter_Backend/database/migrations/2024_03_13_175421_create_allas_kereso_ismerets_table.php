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
        Schema::create('allas_kereso_ismerets', function (Blueprint $table) {
            $table->foreignId('allaskereso')->references('allas_id')->on('allass');
            $table->foreignId('szakmai_ismeret')->references('ismeret_id')->on('szakmai_ismerets');
            $table->primary(['allaskereso','szakmai_ismeret']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allas_kereso_ismerets');
    }
};
