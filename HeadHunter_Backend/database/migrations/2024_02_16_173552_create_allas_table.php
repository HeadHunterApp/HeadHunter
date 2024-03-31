<?php

use App\Models\Allas;
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
        Schema::create('allass', function (Blueprint $table) {
            $table->id('allas_id');
            $table->foreignId('munkaltato')->references('munkaltato_id')->on('munkaltatos');
            $table->string('megnevezes', 30);
            $table->string('pozicio', 6);
            $table->foreign('pozicio')->references('pozkod')->on('pozicios');
            //$table->foreign(['terulet', 'pozicio'])->references(['terulet', 'pozicio'])->on('pozicios'); - összetett kulcsok felszámolása
            $table->string('statusz', 40);
            $table->longText('leiras');
            $table->date('datum');
            $table->foreignId('fejvadasz')->references('user_id')->on('fejvadaszs')->nullable();
            $table->timestamps();
        });
/*
        Allas::create([
            'munkaltato' => 1,
            'megnevezes' => 'Szoftvermérnök',
            'pozicio' => 100,
            'statusz' => 'nyitott',
            'leiras' => 'Izga
            'datum' => '2024-03-20',
            'fejvadasz' => 1,
        ]);
        
        Allas::create([
            'munkaltato' => 1,
            'megnevezes' => 'Adattudós',
            'pozicio' => 100,
            'statusz' => 'nyitott',
            'leiras' => 'Csatlakozzon adattudományi csapatunkhoz, hogy cutting-edge projekteken dolgozzon. Olyan személyeket keresünk, akik jártasak az adatelemzésben, a gépi tanulásban és az adatvizualizációban. Az R vagy Python programozási nyelvek ismerete előnyös.',
            'datum' => '2024-03-20',
            'fejvadasz' => 1,
        ]);
        
        Allas::create([
            'munkaltato' => 1,
            'megnevezes' => 'Termékmenedzser',
            'pozicio' => 100,
            'statusz' => 'nyitott',
            'leiras' => 'Vezesse a termékfejlesztést és az innovációs kezdeményezéseket. Olyan személyeket keresünk, akik erős vezetői készségekkel rendelkeznek, és tapasztalattal rendelkeznek a termék életciklusának kezelésében. Kiváló kommunikációs és problémamegoldó képességek elengedhetetlenek ennek a szerepnek.',
            'datum' => '2024-03-20',
            'fejvadasz' => 1,
        ]);
        
        Allas::create([
            'munkaltato' => 1,
            'megnevezes' => 'UX/UI Tervező',
            'pozicio' => 100,
            'statusz' => 'nyitott',
            'leiras' => 'Keresünk egy kreatív UX/UI tervezőt, aki javítja a felhasználói élményt. Az ideális jelöltnek erős portfólióval kell rendelkeznie, amely bemutatja tervezői készségeit, valamint tapasztalattal kell rendelkeznie drótvázak és prototípusok készítésében. A felhasználói kutatási módszerek ismerete előny.',
            'datum' => '2024-03-20',
            'fejvadasz' => 1,
        ]);
        
        Allas::create([
            'munkaltato' => 1,
            'megnevezes' => 'Marketing Szakértő',
            'pozicio' => 100,
            'statusz' => 'nyitott',
            'leiras' => 'Vezesse a marketingkampányokat és -stratégiákat termékeinkhez. A jelöltnek mélyrehatóan kell ismernie a digitális marketingcsatornákat és az analitikát. A tartalom létrehozásának, az SEO-nak és a közösségi média marketingnek való tapasztalata nagyra értékelhető.',
            'datum' => '2024-03-20',
            'fejvadasz' => 1,
        ]);
        
        Allas::create([
            'munkaltato' => 1,
            'megnevezes' => 'Frontend Fejlesztő',
            'pozicio' => 100,
            'statusz' => 'nyitott',
            'leiras' => 'Lehetőség egy frontend fejlesztőnek felhasználói felületek készítésére. Olyan jelölteket keresünk, akik jártasak a frontend technológiákban, mint például az HTML, CSS és JavaScript keretrendszerek, például a React vagy az Angular. A reszponzív tervezés és a böngészőkompatibilitás is fontos.',
            'datum' => '2024-03-20',
            'fejvadasz' => 1,
        ]);
        
        Allas::create([
            'munkaltato' => 1,
            'megnevezes' => 'Backend Mérnök',
            'pozicio' => 100,
            'statusz' => 'nyitott',
            'leiras' => 'Csatlakozzon backend mérnöki csapatunkhoz, hogy skálázható rendszereket fejlesszen. Az ideális jelöltnek jártassága kell, hogy legyen backend technológiákban, például a Node.js, Python vagy Java terén. Tapasztalat szükséges adatbázis-kezelési rendszerekben és API fejlesztésben.',
            'datum' => '2024-03-20',
            'fejvadasz' => 1,
        ]);
     */   
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allass');
    }
};
