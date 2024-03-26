<?php

use App\Models\AllasVegzettseg;
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
        Schema::create('allas_vegzettsegs', function (Blueprint $table) {
            $table->foreignId('allas')->references('allas_id')->on('allass');
            $table->foreignId('vegzettseg')->references('vegzettseg_id')->on('vegzettsegs');
            $table->primary('allas');
        });
         
        //tesztadatok

        AllasVegzettseg::create([
            'allas' => 1,
            'vegzettseg' => 3,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allas_vegzettsegs');
    }
};
