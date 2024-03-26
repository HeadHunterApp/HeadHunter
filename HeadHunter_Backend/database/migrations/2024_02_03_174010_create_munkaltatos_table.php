<?php

use App\Models\Munkaltato;
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
        Schema::create('munkaltatos', function (Blueprint $table) {
            $table->id('munkaltato_id');
            $table->string('cegnev', 60);
            $table->string('szekhely', 80);
            $table->string('kapcsolattarto', 40);
            $table->string('telefonszam', 12)->nullable();
            $table->string('email', 40)->unique();
            $table->timestamps();
        });
        
        //tesztadatok

        Munkaltato::create([
            'cegnev' => 'Valami Kft.', 
            'szekhely' => '1081 Budapest, II. János Pál pápa tér 2.', 
            'kapcsolattarto' => 'Valaki József',
            'telefonszam' => '+36201234567',
            'email' => 'valami@valami.hu'
        ]);
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('munkaltatos');
    }
};
