<?php

use App\Models\AllaskeresoTanulmany;
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
        Schema::create('allaskereso_tanulmanys', function (Blueprint $table) {
            $table->foreignId('allaskereso')->references('user_id')->on('allaskeresos');
            $table->string('intezmeny', 50);
            $table->string('szak', 50);
            $table->primary(['allaskereso','intezmeny','szak']);
            $table->foreignId('vegzettseg')->references('vegzettseg_id')->on('vegzettsegs');
            $table->date('kezdes');
            $table->date('vegzes')->nullable();
            $table->longText('erintett_targytev', 250)->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allaskereso_tanulmanys');
    }
};
