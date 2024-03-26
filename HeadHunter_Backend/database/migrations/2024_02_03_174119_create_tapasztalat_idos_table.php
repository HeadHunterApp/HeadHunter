<?php

use App\Models\TapasztalatIdo;
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
        Schema::create('tapasztalat_idos', function (Blueprint $table) {
            $table->id('tapasztalat_id');
            $table->string('leiras', 20);
        });

        //FIX ADATOK

        TapasztalatIdo::create([
            'leiras' => 'pályakezdő (0-1 év)',
        ]);
        
        TapasztalatIdo::create([
            'leiras' => '1-3 év tapasztalat',
        ]);
        
        TapasztalatIdo::create([
            'leiras' => '3-5 év tapasztalat',
        ]);
        
        TapasztalatIdo::create([
            'leiras' => '5+ év tapasztalat',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tapasztalat_idos');
    }
};
