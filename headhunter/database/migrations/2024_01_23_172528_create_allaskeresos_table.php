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
        Schema::create('allaskeresos', function (Blueprint $table) {
            $table->id('allasker_ID');
            $table->string('nev', 50);
            $table->string('nem', 10);
            $table->date('szul_ido');
            $table->string('telefonszam', 15);
            $table->string('fax', 15);
            $table->string('email')->unique();
            $table->string('allampolgarsag', 20);
            $table->string('jogositvany');
            $table->string('szoc_keszseg', 40);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allaskeresos');
    }
};
