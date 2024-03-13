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
            $table->id('user_id');
            $table->string('nem', 5);
            $table->date('szul_ido');
            $table->string('telefonszam', 12);
            $table->string('fax', 11);
            $table->string('allampolgarsag', 20);
            $table->boolean('jogositvany');
            $table->longText('szoc_keszseg', 150);
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
