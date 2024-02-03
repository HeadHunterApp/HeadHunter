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
        Schema::create('nyelvtudas', function (Blueprint $table) {
            $table->primary(['nyelv', 'szint']); 
            $table->string('nyelv', 20);
            $table->string('szint', 20);
            $table->string('megnevezes', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nyelvtudas');
    }
};
