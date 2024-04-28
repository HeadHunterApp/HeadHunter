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
        Schema::create('allas_jelentkezos', function (Blueprint $table) {
            $table->foreignId('allas')->references('allas_id')->on('allass');
            $table->foreignId('allaskereso')->references('user_id')->on('allaskeresos');
            $table->primary(['allas','allaskereso']);
            $table->string('statusz', 12)->default('jelentkezett');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allas_jelentkezos');
    }
};
