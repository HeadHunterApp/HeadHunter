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
        Schema::create('allas_tapasztalats', function (Blueprint $table) {
            $table->foreignId('allas')->references('allas_id')->on('allass');
            $table->string('pozicio', 6);
            $table->foreign('pozicio')->references('pozkod')->on('pozicios');
            $table->foreignId('tapasztalat_ido')->references('tapasztalat_id')->on('tapasztalat_idos');
            $table->primary('allas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allas_tapasztalats');
    }
};
