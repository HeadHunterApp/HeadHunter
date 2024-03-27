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
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nyelvtudass');
    }
};
