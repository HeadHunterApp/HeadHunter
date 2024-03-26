<?php

use App\Models\Allaskereso;
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
        Schema::create('allaskeresos', function (Blueprint $table) {
            $table->foreignId('user_id')->references('user_id')->on('users')->primary();
            $table->string('nem', 5);
            $table->date('szul_ido');
            $table->string('telefonszam', 12)->nullable();
            $table->string('fax', 12)->nullable();
            $table->string('allampolgarsag', 20)->default('magyar');
            $table->boolean('jogositvany');
            $table->longText('szoc_keszseg', 150);
            $table->timestamps();
        });

        
        //tesztadatok

        //----FONTOS!!! USER_ID=1 MINDIG AZ ADMIN, MÁS SZÁMOKAT HASZNÁLJATOK!!!----

        Allaskereso::create([
            'user_id' => 3,
            'nem' => 'nő',
            'szul_ido' => '1999/09/09',
            'telefonszam' => '+36301234567',
            'fax' => '+361123456',
            'allampolgarsag' => 'magyar',
            'jogositvany' => false,
            'szoc_keszseg' => 'jó kommunikációs készség, kiváló munka csapatban és önállóan egyeránt',
        ]);

        Allaskereso::create([
            'user_id' => 4,
            'nem' => 'férfi',
            'szul_ido' => '2002/02/02',
            'telefonszam' => '+36709876543',
            'fax' => '',
            'allampolgarsag' => 'magyar',
            'jogositvany' => true,
            'szoc_keszseg' => 'úgy gondolom, jó velem együtt dolgozni',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allaskeresos');
    }
};
