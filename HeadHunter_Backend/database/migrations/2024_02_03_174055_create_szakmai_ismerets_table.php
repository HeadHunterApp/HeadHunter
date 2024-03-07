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
        Schema::create('szakmai_ismerets', function (Blueprint $table) {
            $table->id('ismeret_id');
            $table->string('megnevezes', 40);
            $table->string('szint', 40);
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('szakmai_ismerets');
    }
};
