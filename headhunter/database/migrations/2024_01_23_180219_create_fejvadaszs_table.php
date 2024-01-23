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
            $table->id('fejv_ID');
            $table->string('nev', 50);
            $table->string('tel', 15);
            $table->string('email')->unique();
            $table->binary('fenykep');
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
