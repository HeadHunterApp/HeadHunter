<?php

use App\Models\Fejvadasz;
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
        Schema::create('fejvadaszs', function (Blueprint $table) {
            $table->foreignId('user_id')->references('user_id')->on('users')->primary();
            $table->string('telefonszam', 12)->nullable();
            $table->string('fenykep', 150);
            $table->timestamps();
        });
        
        //tesztadatok

        //----FONTOS!!! USER_ID=1 MINDIG AZ ADMIN, MÁS SZÁMOKAT HASZNÁLJATOK!!!----

        Fejvadasz::create([
            'user_id' => 2,
            'telefonszam' => '+36201234567',
            'fenykep' => 'jpg',
        ]);

        
        Fejvadasz::create([
            'user_id' => 5,
            'telefonszam' => '+36201239876',
            'fenykep' => 'masikjpg',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fejvadaszs');
    }
};
