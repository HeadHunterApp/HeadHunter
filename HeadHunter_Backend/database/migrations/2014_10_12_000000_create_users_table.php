<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('nev', 40);
            $table->string('email', 40)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('jelszo');
            $table->string('jogosultsag', 255);
            $table->rememberToken();
            $table->timestamps();
        });

        //FIX ADAT
        //only one user with jogosultsag='admin'

        User::create([
            'nev' => 'Admin', 
            'email' => 'admin@headhunter.com', 
            'jelszo' => 'admin123',
            'jogosultsag' => 'admin',
        ]);

        //tesztadatok

        User::create([
            'nev' => 'Minta-Fejvadász András', 
            'email' => 'a.minta-fejv@headhunter.com', 
            'jelszo' => 'newpass123',
            'jogosultsag' => 'fejvadasz',
        ]);

        User::create([
            'nev' => 'Példa-Álláskereső Lilla', 
            'email' => 'lilla-pallker@gmail.com', 
            'jelszo' => 'jelszo123',
            'jogosultsag' => 'allaskereso',
        ]);

        User::create([
            'nev' => 'Holameló Béla', 
            'email' => 'bela-the-king@freemail.hu', 
            'jelszo' => 'almafa',
            'jogosultsag' => 'allaskereso',
        ]);

        User::create([
            'nev' => 'Beoszt Tivadar', 
            'email' => 't.beoszt@headhunter.com', 
            'jelszo' => 'newpass123',
            'jogosultsag' => 'fejvadasz',
        ]);
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
