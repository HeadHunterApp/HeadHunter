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
        Schema::create('munkaltatos', function (Blueprint $table) {
            $table->id('munkaltato_ID');
            $table->string('cegnev', 30);
            $table->string('szekhely', 50);
            $table->string('kapcsolattarto', 50);
            $table->string('telefonszam', 15);
            $table->string('email')->unique();
            //$table->timestamps();
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
