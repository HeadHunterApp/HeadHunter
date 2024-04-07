<?php

use App\Models\Allaskereso;
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
            $table->foreignId('user_id')->references('user_id')->on('users')->primary();
            $table->string('nem', 5);
            $table->date('szul_ido');
            $table->string('telefonszam', 12)->nullable();
            $table->string('fax', 12)->nullable();
            $table->string('allampolgarsag', 20)->default('magyar');
            $table->boolean('jogositvany');
            $table->longText('szoc_keszseg', 150);
            /* $table->string('fenykep', 150)->nullable(); */
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
