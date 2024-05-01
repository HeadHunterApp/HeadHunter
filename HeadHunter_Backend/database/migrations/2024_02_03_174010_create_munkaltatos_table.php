<?php

use App\Models\Munkaltato;
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
        Schema::create('munkaltatos', function (Blueprint $table) {
            $table->id('munkaltato_id');
            $table->string('cegnev', 60);
            $table->string('szekhely', 80);
            $table->string('kapcsolattarto', 40);
            $table->string('telefonszam', 30)->nullable();
            $table->string('email', 40)->unique();
            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('munkaltatos');
    }
};
