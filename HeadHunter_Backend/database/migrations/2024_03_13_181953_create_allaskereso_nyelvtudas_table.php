<?php

use App\Models\AllaskeresoNyelvtudas;
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
        Schema::create('allaskereso_nyelvtudass', function (Blueprint $table) {
            $table->foreignId('allaskereso')->references('user_id')->on('allaskeresos');
            $table->string('nyelvtudas', 4);
            $table->foreign('nyelvtudas')->references('nyelvkod')->on('nyelvtudass');
            $table->primary(['allaskereso','nyelvtudas']);
            $table->boolean('nyelvvizsga')->default(false);
            $table->string('iras', 15)->nullable();
            $table->string('olvasas', 15)->nullable();
            $table->string('beszed', 15)->nullable();
        });
        
        //tesztadatok

        AllaskeresoNyelvtudas::create([
            'allaskereso' => 3,
            'nyelvtudas' => 'ENB2',
            'nyelvvizsga' => true,
            'iras' => 'B2',
            'olvasas' => 'B2',
            'beszed' => 'B2',
        ]);

        AllaskeresoNyelvtudas::create([
            'allaskereso' => 3,
            'nyelvtudas' => 'DEB2',
            'nyelvvizsga' => false,
            'iras' => 'középszint',
            'olvasas' => 'középszint',
            'beszed' => 'alapszint',
        ]);

        AllaskeresoNyelvtudas::create([
            'allaskereso' => 4,
            'nyelvtudas' => 'DEA2',
            'nyelvvizsga' => false,
            'iras' => 'alapszint',
            'olvasas' => 'alapszint',
            'beszed' => 'középszint',
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allaskereso_nyelvtudass');
    }
};
