<?php

namespace Database\Seeders;

use App\Models\Allas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        //tesztadatok

        Allas::create([
            'munkaltato' => 1,
            'megnevezes' => 'szoftver fejlesztő',
            'pozicio' => 'INFFRO',
            'statusz' => 'nyitott',
            'leiras' => 'Applikáció fejlesztőként feladatod lesz cégünk jelenlegi, React Native nyelven írt iOS, illetve.',
            'fejvadasz' => 2,
        ]);

        Allas::create([
            'munkaltato' => 1,
            'megnevezes' => 'Szoftvermérnök',
            'pozicio' => 'INFSEN',
            'statusz' => 'nyitott',
            'leiras' => 'Izgalmas mérnöki munka.',
            'fejvadasz' => 2,
        ]);
        
        Allas::create([
            'munkaltato' => 1,
            'megnevezes' => 'Adattudós',
            'pozicio' => 'INFDSC',
            'statusz' => 'nyitott',
            'leiras' => 'Csatlakozzon adattudományi csapatunkhoz, hogy cutting-edge projekteken dolgozzon. Olyan személyeket keresünk, akik jártasak az adatelemzésben, a gépi tanulásban és az adatvizualizációban. Az R vagy Python programozási nyelvek ismerete előnyös.',
            'fejvadasz' => 2,
        ]);
        
        Allas::create([
            'munkaltato' => 1,
            'megnevezes' => 'Termékmenedzser',
            'pozicio' => 'GYTPEN',
            'statusz' => 'nyitott',
            'leiras' => 'Vezesse a termékfejlesztést és az innovációs kezdeményezéseket. Olyan személyeket keresünk, akik erős vezetői készségekkel rendelkeznek, és tapasztalattal rendelkeznek a termék életciklusának kezelésében. Kiváló kommunikációs és problémamegoldó képességek elengedhetetlenek ennek a szerepnek.',
            'fejvadasz' => 5,
        ]);
        
        Allas::create([
            'munkaltato' => 1,
            'megnevezes' => 'UX/UI Tervező',
            'pozicio' => 'GRFUIX',
            'statusz' => 'nyitott',
            'leiras' => 'Keresünk egy kreatív UX/UI tervezőt, aki javítja a felhasználói élményt. Az ideális jelöltnek erős portfólióval kell rendelkeznie, amely bemutatja tervezői készségeit, valamint tapasztalattal kell rendelkeznie drótvázak és prototípusok készítésében. A felhasználói kutatási módszerek ismerete előny.',
            'fejvadasz' => 5,
        ]);
        
        Allas::create([
            'munkaltato' => 1,
            'megnevezes' => 'Marketing Szakértő',
            'pozicio' => 'MARMGR',
            'statusz' => 'nyitott',
            'leiras' => 'Vezesse a marketingkampányokat és -stratégiákat termékeinkhez. A jelöltnek mélyrehatóan kell ismernie a digitális marketingcsatornákat és az analitikát. A tartalom létrehozásának, az SEO-nak és a közösségi média marketingnek való tapasztalata nagyra értékelhető.',
            'fejvadasz' => 5,
        ]);
        
        Allas::create([
            'munkaltato' => 1,
            'megnevezes' => 'Frontend Fejlesztő',
            'pozicio' => 'INFFRO',
            'statusz' => 'nyitott',
            'leiras' => 'Lehetőség egy frontend fejlesztőnek felhasználói felületek készítésére. Olyan jelölteket keresünk, akik jártasak a frontend technológiákban, mint például az HTML, CSS és JavaScript keretrendszerek, például a React vagy az Angular. A reszponzív tervezés és a böngészőkompatibilitás is fontos.',
            'fejvadasz' => 2,
        ]);
        
        Allas::create([
            'munkaltato' => 1,
            'megnevezes' => 'Backend Mérnök',
            'pozicio' => 'INFBCK',
            'statusz' => 'nyitott',
            'leiras' => 'Csatlakozzon backend mérnöki csapatunkhoz, hogy skálázható rendszereket fejlesszen. Az ideális jelöltnek jártassága kell, hogy legyen backend technológiákban, például a Node.js, Python vagy Java terén. Tapasztalat szükséges adatbázis-kezelési rendszerekben és API fejlesztésben.',
            'fejvadasz' => 2,
        ]);
    }
}
