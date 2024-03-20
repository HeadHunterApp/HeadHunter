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
        Schema::create('fejvadasz_terulets', function (Blueprint $table) {
            $table->foreignId('fejvadasz')->references('user_id')->on('fejvadaszs');
            $table->foreignId('terulet')->references('terulet_id')->on('terulets');
            $table->primary(['fejvadasz','terulet']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fejvadasz_terulets');
    }
};
