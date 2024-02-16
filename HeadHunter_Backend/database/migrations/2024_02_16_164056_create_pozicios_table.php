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
        Schema::create('pozicios', function (Blueprint $table) {
            $table->string('pozicio', 20)->primary();
            //$table->timestamps();
            $table->foreignId('terulet')->references('megnevezes')->on('terulets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pozicios');
    }
};
