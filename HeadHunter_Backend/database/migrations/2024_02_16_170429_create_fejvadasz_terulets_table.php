<?php

use App\Models\FejvadaszTerulet;
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
        Schema::create('fejvadasz_terulets', function (Blueprint $table) {
            $table->foreignId('fejvadasz')->references('user_id')->on('fejvadaszs');
            $table->foreignId('terulet')->references('terulet_id')->on('terulets');
            $table->primary(['fejvadasz','terulet']);
        });        
        
        //tesztadatok

        FejvadaszTerulet::create([
            'fejvadasz' => 2,
            'terulet' => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fejvadasz_terulets');
    }
};
