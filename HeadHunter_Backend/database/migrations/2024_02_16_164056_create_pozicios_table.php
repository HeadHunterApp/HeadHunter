<?php

use App\Models\Pozicio;
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
            //$table->primary(['terulet', 'pozicio']); - összetett kulcsok felszámolása
            $table->string('pozkod', 6)->primary();
            $table->foreignId('terulet')->references('terulet_id')->on('terulets');
            $table->string('pozicio', 20);
            //$table->timestamps();
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