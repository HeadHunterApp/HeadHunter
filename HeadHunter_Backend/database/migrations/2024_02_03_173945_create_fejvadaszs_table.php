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
        Schema::create('fejvadaszs', function (Blueprint $table) {
            $table->foreignId('user_id')->references('user_id')->on('users')->primary();
            $table->string('telefonszam', 12)->nullable();
            $table->string('fenykep', 150);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fejvadaszs');
    }
};
