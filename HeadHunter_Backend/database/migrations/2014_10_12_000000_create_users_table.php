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
            //  $table->timestamp('email_verified_at')->nullable();
            //később még betehetjük az e-mail cím verifikálást
            $table->string('jelszo');
            $table->string('jogosultsag', 20);
            $table->rememberToken();
            $table->timestamps();
        });

        User::create([
            'nev' => 'Admin', 
            'email' => 'admin@headhunter.com', 
            'jelszo' => 'admin123',
            'jogosultsag' => 'admin',
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
