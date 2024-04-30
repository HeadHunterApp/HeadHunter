<?php

use App\Models\Terulet;
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
        Schema::create('terulets', function (Blueprint $table) {
            $table->id('terulet_id');
            $table->string('megnevezes');
        });

/*        Terulet::create([
            'megnevezes' => 'Informatika', 
        ]);
        Terulet::create([
            'megnevezes' => 'Értékesítés', 
        ]);
        Terulet::create([
            'megnevezes' => 'Marketing', 
        ]);  */ 

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terulets');
    }
};
