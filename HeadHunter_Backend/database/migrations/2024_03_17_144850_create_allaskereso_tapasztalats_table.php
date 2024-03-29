<?php

use App\Models\AllaskeresoTapasztalat;
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
        Schema::create('allaskereso_tapasztalats', function (Blueprint $table) {
            $table->foreignId('allaskereso')->references('user_id')->on('allaskeresos');
            $table->string('cegnev', 40);
            $table->string('pozicio', 6);
            $table->foreign('pozicio')->references('pozkod')->on('pozicios');
            $table->primary(['allaskereso','cegnev','pozicio']);
            $table->date('kezdes');
            $table->date('vegzes')->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allaskereso_tapasztalats');
    }
};
