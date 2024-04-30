<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('nev', 50);
            $table->string('email', 40)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('jogosultsag', 12);
            $table->string('fenykep')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        //FIX ADAT
        //only one user with jogosultsag='admin'

        User::create([
            'nev' => 'Admin', 
            'email' => 'admin@headhunter.com', 
            'password' => Hash::make('Admin123.'),
            'jogosultsag' => 'admin',
        ]);


        //ezt majd ki kell szedni!!!
/*         User::create([
            'nev' => 'Huba BUba', 
            'email' => 'huba@gmail.com', 
            'password' => Hash::make('Hubabuba123.'),
            'jogosultsag' => 'fejvadász',
        ]);  */
         
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
