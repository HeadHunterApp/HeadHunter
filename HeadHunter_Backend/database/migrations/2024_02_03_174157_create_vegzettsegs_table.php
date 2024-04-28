<?php

use App\Models\Vegzettseg;
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
        Schema::create('vegzettsegs', function (Blueprint $table) {
            $table->id('vegzettseg_id');
            $table->string('megnevezes', 25);
        });
        
        //FIX ADATOK

    Vegzettseg::create([
            'megnevezes' => 'általános iskola',
        ]);

        Vegzettseg::create([
            'megnevezes' => 'középiskola - érettségi',
        ]);

        Vegzettseg::create([
            'megnevezes' => 'középfokú szakképzés',
        ]);
        
        Vegzettseg::create([
            'megnevezes' => 'felsőfokú szakképzés',
        ]);
        
        Vegzettseg::create([
            'megnevezes' => 'főiskola/egyetem - BA/BSC',
        ]);
        
        Vegzettseg::create([
            'megnevezes' => 'egyetem - MA/MSC',
        ]);
        
        Vegzettseg::create([
            'megnevezes' => 'egyetem - DR',
        ]);
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vegzettsegs');
    }
};
