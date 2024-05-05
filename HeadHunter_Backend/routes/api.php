<?php

use App\Http\Controllers\AllasController;
use App\Http\Controllers\AllasIsmeretController;
use App\Http\Controllers\AllasJelentkezoController;
use App\Http\Controllers\AllaskeresoController;
use App\Http\Controllers\AllaskeresoIsmeretController;
use App\Http\Controllers\AllaskeresoNyelvtudasController;
use App\Http\Controllers\AllaskeresoTanulmanyController;
use App\Http\Controllers\AllaskeresoTapasztalatController;
use App\Http\Controllers\AllasNyelvtudasController;
use App\Http\Controllers\AllasTapasztalatController;
use App\Http\Controllers\AllasVegzettsegController;
use App\Http\Controllers\FejvadaszController;
use App\Http\Controllers\FejvadaszTeruletController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MunkaltatoController;
use App\Http\Controllers\NyelvtudasController;
use App\Http\Controllers\PozicioController;
use App\Http\Controllers\SzakmaiIsmeretController;
use App\Http\Controllers\TapasztalatIdoController;
use App\Http\Controllers\TeruletController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VegzettsegController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/token', function () {
    return request()->session()->token();
});


//regisztrációhoz bejelentkezés nélkül alábbi route HELYETT a Breeze - RegistredUserController kezeli
//Route::post('/guest/jobseekers/new', [AllaskeresoController::class, 'store']);

//álláskereső oldalhoz route-ok:
//allas


Route::get('/jobs-basic/all', [AllasController::class, 'shortAllasAll']);
Route::get('/jobs-basic/{allas_id}', [AllasController::class, 'detailedAllas'])->whereNumber('allas_id');
//allas-kapcsolódók
Route::get('/jobs/{allas_id}/skills', [AllasIsmeretController::class, 'detailedAllasIsm']);
Route::get('/jobs/{allas_id}/languages', [AllasNyelvtudasController::class, 'detailedAllasNyelv']);
Route::get('/jobs/{allas_id}/edu-atts', [AllasVegzettsegController::class, 'detailedAllasVegz']);
Route::get('/jobs/{allas_id}/exps', [AllasTapasztalatController::class, 'detailedAllasTap']);
//munkaltato teszt routeok:

Route::get('/munkaltatok/all', [MunkaltatoController::class, 'index']);
Route::post('/munkaltatok/munkaltato', [MunkaltatoController::class, 'store']);
Route::delete('/munkaltatok/{munkaltato_id}', [MunkaltatoController::class, 'destroy'])->whereNumber('munkaltato_id');
Route::put('/munkaltatok/{munkaltato_id}', [MunkaltatoController::class, 'update'])->whereNumber('munkaltato_id');
//munkaltato tesztek vége
//allasok teszt rouetok
Route::get('/jobs/all', [AllasController::class, 'index']);
Route::post('/jobs/new', [AllasController::class, 'store']);
Route::put('/jobs/modification/{allas_id}', [AllasController::class, 'update']);
Route::delete('/jobs/delete/{allas_id}', [AllasController::class, 'destroy']);

//allasok tesz rouetok vége
Route::get('/jobs-basic/{allas_id}/skills', [AllasIsmeretController::class, 'detailedAllasIsm']);
Route::get('/jobs-basic/{allas_id}/languages', [AllasNyelvtudasController::class, 'detailedAllasNyelv']);
Route::get('/jobs-basic/{allas_id}/edu-atts', [AllasVegzettsegController::class, 'detailedAllasVegz']);
Route::get('/jobs-basic/{allas_id}/exps', [AllasTapasztalatController::class, 'detailedAllasTap']);


Route::middleware('auth')->group(function () {
    // bejelentkezett felhasználók
    Route::post('/user/profile/image', [UserController::class, 'uploadImage']);
    //terulet
    Route::get('/fields-all', [TeruletController::class, 'index']);
    Route::get('/fields/{terulet_id}', [TeruletController::class, 'show'])->whereNumber('terulet_id');
    //pozicio
    Route::get('/positions-all', [PozicioController::class, 'index']);
    Route::get('/positions/{pozkod}', [PozicioController::class], 'show');
    //szakmai ismeret
    Route::get('/skills-all', [SzakmaiIsmeretController::class, 'index']);
    Route::get('/skills/{ismeret_id}', [SzakmaiIsmeretController::class, 'show'])->whereNumber('ismeret_id');
    //vegzettseg
    Route::get('/edu-attainments-all', [VegzettsegController::class, 'index']);
    Route::get('/edu-attainments/{vegzettseg_id}', [VegzettsegController::class, 'show']);
    //nyelvtudas
    Route::get('/languages-all', [NyelvtudasController::class, 'index']);
    Route::get('/languages/{nyelvkod}', [NyelvtudasController::class, 'show']);
    //tapasztalat_ido
    Route::get('/experiences-all', [TapasztalatIdoController::class, 'index']);
    Route::get('/experiences/{tapasztalat_id}', [TapasztalatIdoController::class, 'show']);

    //file feltöltés:
    Route::post('/file-upload', [FileController::class, 'store'])->name('file_store');

    //allaskereso lista:
    Route::get('/seeker/all', [AllaskeresoController::class, 'index']);

    //Allaskereso id alapján
    Route::get('/seekers/{user_id}', [AllaskeresoController::class, 'showAllByUser'])
        ->whereNumber('user_id');

    //Allaskereso nyelvtudás id alapján
    Route::get('/seekers/{user_id}/languages', [AllaskeresoNyelvtudasController::class, 'showAllByUser'])
        ->whereNumber('user_id');

    //Allaskereso tanulmány id alapján
    Route::get('/seekers/{user_id}/edu-atts', [AllaskeresoTanulmanyController::class, 'showAllByUser'])
        ->whereNumber('user_id');

    //Allaskereso tapasztalat id alapján
    Route::get('/seekers/{user_id}/exps', [AllaskeresoTapasztalatController::class, 'showAllByUser'])
        ->whereNumber('user_id');

    Route::middleware(['admin_or_headhunter'])->group(function () {
        //allas
        Route::post('/jobs/new', [AllasController::class, 'store']);
        Route::put('/jobs/modification/{allas_id}', [AllasController::class, 'update']);
        //allas-ismeret
        Route::post('/jobs/skills/new', [AllasIsmeretController::class, 'store']);
        Route::put('/jobs/{allas_id}/skills/modification', [AllasIsmeretController::class, 'update'])->whereNumber('allas_id');
        Route::delete('/jobs/{allas_id}/skills/delete', [AllasIsmeretController::class, 'destroy'])->whereNumber('allas_id');
        //allas-nyelvtudas
        Route::post('/jobs/languages/new', [AllasNyelvtudasController::class, 'store']);
        Route::put('/jobs/{allas_id}/languages/modification', [AllasNyelvtudasController::class, 'update'])->whereNumber('allas_id');
        Route::delete('/jobs/{allas_id}/languages/delete', [AllasNyelvtudasController::class, 'destroy'])->whereNumber('allas_id');
        //allas-vegzettseg
        Route::post('/jobs/edu-atts/new', [AllasVegzettsegController::class, 'store']);
        Route::put('/jobs/{allas_id}/edu-atts/modification', [AllasVegzettsegController::class, 'update'])->whereNumber('allas_id');
        Route::delete('/jobs/{allas_id}/edu-atts/delete', [AllasVegzettsegController::class, 'destroy'])->whereNumber('allas_id');
        //allas-tapasztalat
        Route::post('/jobs/exps/new', [AllasTapasztalatController::class, 'store']);
        Route::put('/jobs/{allas_id}/exps/modification', [AllasTapasztalatController::class, 'update'])->whereNumber('allas_id');
        Route::delete('/jobs/{allas_id}/exps/delete', [AllasTapasztalatController::class, 'destroy'])->whereNumber('allas_id');
        //allas-jelentkezo
        Route::get('/jobs/applicants-all', [AllasJelentkezoController::class, 'detailedJelentkezokAll']);
        Route::get('/jobs/{allas_id}/applicants', [AllasJelentkezoController::class, 'detailedAllasJelentkezok'])->whereNumber('allas_id');
        Route::get('/jobs/applicants/{user_id}', [AllasJelentkezoController::class, 'detailedAllaskerJelentkezesek'])->whereNumber('user_id');
        Route::post('/jobs/applicants/new', [AllasJelentkezoController::class, 'store']);
        Route::put('/jobs/{allas_id}/applicants/modification', [AllasJelentkezoController::class, 'update'])->whereNumber('allas_id');
        //allaskereso
        Route::get('/jobseekers-all', [AllaskeresoController::class, 'index']);
        Route::get('/jobseekers/{user_id}', [AllaskeresoController::class, 'show'])->whereNumber('user_id');
        //allaskereso-kapcsolódók
        Route::get('/jobseekers/{user_id}/skills', [AllaskeresoIsmeretController::class, 'showallasker'])->whereNumber('user_id');
        Route::get('/jobseekers/{user_id}/languages', [AllaskeresoNyelvtudasController::class, 'showallasker'])->whereNumber('user_id');
        Route::get('/jobseekers/{user_id}/edu-atts', [AllaskeresoTanulmanyController::class, 'showallasker'])->whereNumber('user_id');
        Route::get('/jobseekers/{user_id}/exps', [AllaskeresoTapasztalatController::class, 'showallasker'])->whereNumber('user_id');
        //munkaltato
        Route::get('/employers-all', [MunkaltatoController::class, 'index']);
        Route::get('/employers/{munkaltato_id}', [MunkaltatoController::class, 'show'])->whereNumber('munkaltato_id');
        Route::post('/employers/new', [MunkaltatoController::class, 'store']);
        Route::put('/employers/modification/{munkaltato_id}', [MunkaltatoController::class, 'update'])->whereNumber('munkaltato_id');
    });

    Route::middleware(['admin'])->group(function () {
        //user
        Route::get('/users-all', [UserController::class, 'index']);
        Route::get('/users/{user_id}', [UserController::class, 'show'])->whereNumber('user_id');
        Route::delete('/users/delete/{user_id}', [UserController::class, 'destroy'])->whereNumber('user_id');
        //allas
        //csak az alap táblaadatok megjelenítése, id-k által meghívott adatok nélkül:
        Route::get('/jobs-all', [AllasController::class, 'index']);
        Route::get('/jobs/{allas_id}', [AllasController::class, 'show'])->whereNumber('allas_id');
        //törlés:
        Route::delete('/jobs/delete/{allas_id}', [AllasController::class, 'destroy']);
        //allas-ismeret
        Route::get('/jobs/skills', [AllasIsmeretController::class, 'index']);
        Route::get('/jobs/{allas_id}/skills', [AllasIsmeretController::class, 'showallas'])->whereNumber('allas_id');
        //allas-nyelvtudas
        Route::get('/jobs/languages', [AllasNyelvtudasController::class, 'index']);
        Route::get('/jobs/{allas_id}/languages', [AllasNyelvtudasController::class, 'showallas'])->whereNumber('allas_id');
        //allas-vegzettseg
        Route::get('/jobs/edu-atts', [AllasVegzettsegController::class, 'index']);
        Route::get('/jobs/{allas_id}/edu-atts', [AllasVegzettsegController::class, 'showallas'])->whereNumber('allas_id');
        //allas-tapasztalat
        Route::get('/jobs/exps', [AllasTapasztalatController::class, 'index']);
        Route::get('/jobs/{allas_id}/exps', [AllasTapasztalatController::class, 'showallas'])->whereNumber('allas_id');
        //allas-jelentkezo
        //ha id-ket is vissza akarunk kapni
        Route::get('/jobs-admin/applicants-all', [AllasJelentkezoController::class, 'index']);
        Route::get('/jobs-admin/{allas_id}/applicants', [AllasJelentkezoController::class, 'showallas'])->whereNumber('allas_id');
        Route::get('/jobs-admin/applicants/{user_id}', [AllasJelentkezoController::class, 'showallasker'])->whereNumber('user_id');
        Route::delete('/jobs/{allas_id}/applicants/delete', [AllasJelentkezoController::class, 'destroy'])->whereNumber('allas_id');
        //fejvadasz
        Route::get('/headhunters-all', [FejvadaszController::class, 'index']);
        Route::get('/headhunters/{user_id}', [FejvadaszController::class, 'show'])->whereNumber('user_id');
        Route::post('/headhunters/new', [FejvadaszController::class, 'store']);
        Route::put('/headhunters/modification/{user_id}', [FejvadaszController::class, 'update'])->whereNumber('user_id');
        Route::delete('/headhunters/delete/{user_id}', [FejvadaszController::class, 'destroy'])->whereNumber('user_id');
        //fejvadasz-terulet
        Route::get('/headhunters/fields', [FejvadaszTeruletController::class, 'index']);
        Route::get('/headhunters/{user_id}/fields', [FejvadaszTeruletController::class, 'showfejv'])->whereNumber('user_id');
        Route::post('/headhunters/fields/new', [FejvadaszTeruletController::class, 'store']);
        Route::put('/headhunters/{user_id}/fields/modification', [FejvadaszTeruletController::class, 'update'])->whereNumber('user_id');
        Route::delete('/headhunters/{user_id}/fields/delete', [FejvadaszTeruletController::class, 'destroy'])->whereNumber('user_id');
        //allaskereso
        Route::post('/jobseekers/new', [AllaskeresoController::class, 'store']);
        Route::put('/jobseekers/modification/{user_id}', [AllaskeresoController::class, 'update'])->whereNumber('user_id');
        Route::delete('/jobseekers/delete/{user_id}', [AllaskeresoController::class, 'destroy'])->whereNumber('user_id');
        //allaskereso-ismeret
        Route::get('/jobseekers/skills', [AllaskeresoIsmeretController::class, 'index']);
        //ha id-ket is vissza akarunk kapni
        Route::get('/jobseekers-admin/{user_id}/skills', [AllaskeresoIsmeretController::class, 'showallasker'])->whereNumber('user_id');
        Route::post('/jobseekers/skills/new', [AllaskeresoIsmeretController::class, 'store']);
        Route::put('/jobseekers/{user_id}/skills/modification', [AllaskeresoIsmeretController::class, 'update'])->whereNumber('user_id');
        Route::delete('/jobseekers/{user_id}/skills/delete', [AllaskeresoIsmeretController::class, 'destroy'])->whereNumber('user_id');
        //allaskereso-nyelvtudas
        Route::get('/jobseekers/languages', [AllaskeresoNyelvtudasController::class, 'index']);
        //ha id-ket is vissza akarunk kapni
        Route::get('/jobseekers-admin/{user_id}/languages', [AllaskeresoNyelvtudasController::class, 'showallasker'])->whereNumber('user_id');
        Route::post('/jobseekers/languages/new', [AllaskeresoNyelvtudasController::class, 'store']);
        Route::put('/jobseekers/{user_id}/languages/modification', [AllaskeresoNyelvtudasController::class, 'update'])->whereNumber('user_id');
        Route::delete('/jobseekers/{user_id}/languages/delete', [AllaskeresoNyelvtudasController::class, 'destroy'])->whereNumber('user_id');
        //allaskereso-tanulmany
        Route::get('/jobseekers/edu-atts', [AllaskeresoTanulmanyController::class, 'index']);
        //ha id-ket is vissza akarunk kapni
        Route::get('/jobseekers-admin/{user_id}/edu-atts', [AllaskeresoTanulmanyController::class, 'showallasker'])->whereNumber('user_id');
        Route::post('/jobseekers/edu-atts/new', [AllaskeresoTanulmanyController::class, 'store']);
        Route::put('/jobseekers/{user_id}/edu-atts/modification', [AllaskeresoTanulmanyController::class, 'update'])->whereNumber('user_id');
        Route::delete('/jobseekers/{user_id}/edu-atts/delete', [AllaskeresoTanulmanyController::class, 'destroy'])->whereNumber('user_id');
        //allaskereso-tapasztalat
        Route::get('/jobseekers/exps', [AllaskeresoTapasztalatController::class, 'index']);
        //ha id-ket is vissza akarunk kapni
        Route::get('/jobseekers-admin/{user_id}/exps', [AllaskeresoTapasztalatController::class, 'showallasker'])->whereNumber('user_id');
        Route::post('/jobseekers/exps/new', [AllaskeresoTapasztalatController::class, 'store']);
        Route::put('/jobseekers/{user_id}/exps/modification', [AllaskeresoTapasztalatController::class, 'update'])->whereNumber('user_id');
        Route::delete('/jobseekers/{user_id}/exps/delete', [AllaskeresoTapasztalatController::class, 'destroy'])->whereNumber('user_id');
        //munkaltato
        Route::delete('/employers/delete/{munkaltato_id}', [MunkaltatoController::class, 'destroy'])->whereNumber('munkaltato_id');
        //terulet
        Route::post('/fields/new', [TeruletController::class, 'store]']);
        Route::put('/fields/modification/{terulet_id}', [TeruletController::class, 'update'])->whereNumber('terulet_id');
        Route::delete('/fields/delete/{terulet_id}', [TeruletController::class, 'destroy'])->whereNumber('terulet_id');
        //pozicio
        Route::post('/positions/new', [PozicioController::class], 'store');
        Route::put('/positions/modification/{pozkod}', [PozicioController::class], 'update');
        Route::delete('/positions/delete/{pozkod}', [PozicioController::class, 'destroy']);
        //szakmai ismeret
        Route::post('/skills/new', [SzakmaiIsmeretController::class, 'store']);
        Route::put('/skills/modification/{ismeret_id}', [SzakmaiIsmeretController::class, 'update'])->whereNumber('ismeret_id');
        Route::delete('/skills/delete/{ismeret_id}', [SzakmaiIsmeretController::class, 'destroy'])->whereNumber('ismeret_id');
        //nyelvtudas
        Route::post('/languages/new', [NyelvtudasController::class, 'store']);
        Route::put('/languages/modification/{nyelvkod}', [NyelvtudasController::class, 'update']);
        Route::delete('/languages/delete/{nyelvkod}', [NyelvtudasController::class, 'destroy']);
    });
    Route::middleware(['headhunter'])->group(function () {
        //fejvadasz
        Route::get('/headhunters/profile/v2', [FejvadaszController::class, 'showsignedv2']);
        Route::put('/headhunters/profile/modification/v2', [FejvadaszController::class, 'updatesignedv2']);
        Route::get('/headhunters/profile', [FejvadaszController::class, 'showsigned']);
        Route::put('/headhunters/profile/modification', [FejvadaszController::class, 'updatesigned']);
        Route::post('/headhunters/profile/image', [FejvadaszController::class, 'uploadImage']);
        //fejvadasz-terulet
        Route::get('/headhunters/profile/fields', [FejvadaszTeruletController::class, 'showsigned']);
    });
    Route::middleware(['jobseeker'])->group(function () {
        //allaskereso
        Route::get('/jobseekers/profile/v2', [AllaskeresoController::class, 'showsignedv2']);
        Route::put('/jobseekers/profile/modification/v2', [AllaskeresoController::class, 'updatesignedv2']);
        Route::get('/jobseekers/profile', [AllaskeresoController::class, 'showsigned']);
        Route::put('/jobseekers/profile/modification', [AllaskeresoController::class, 'updatesigned']);
        //allaskereso-ismeret
        Route::get('/jobseekers/profile/skills', [AllaskeresoIsmeretController::class, 'showsigned']);
        Route::post('/jobseekers/profile/skills/new', [AllaskeresoIsmeretController::class, 'storesigned']);
        Route::put('/jobseekers/profile/skills/modification', [AllaskeresoIsmeretController::class, 'updatesigned']);
        //nyelvtudas
        Route::get('/jobseekers/profile/languages/v2', [AllaskeresoNyelvtudasController::class, 'showsignedv2']);
        Route::put('/jobseekers/profile/languages/modification/v2', [AllaskeresoNyelvtudasController::class, 'updatesignedv2']);
        Route::get('/jobseekers/profile/languages', [AllaskeresoNyelvtudasController::class, 'showsigned']);
        Route::post('/jobseekers/profile/languages/new', [AllaskeresoNyelvtudasController::class, 'storesigned']);
        Route::put('/jobseekers/profile/languages/modification', [AllaskeresoNyelvtudasController::class, 'updatesigned']);
        Route::delete('/jobseekers/profile/languages/delete', [AllaskeresoNyelvtudasController::class, 'destroySigned']);
        //file feltöltés:
        Route::post('/seeker/file-upload', [FileController::class, 'store'])->name('file_store');
        //allaskereso-tanulmany
        Route::get('/jobseekers/profile/edu-atts/v2', [AllaskeresoTanulmanyController::class, 'showsignedv2']);
        Route::put('/jobseekers/profile/edu-atts/modification/v2', [AllaskeresoTanulmanyController::class, 'updatesignedv2']);
        Route::get('/jobseekers/profile/edu-atts', [AllaskeresoTanulmanyController::class, 'showsigned']);
        Route::post('/jobseekers/profile/edu-atts/new', [AllaskeresoTanulmanyController::class, 'storesigned']);
        Route::put('/jobseekers/profile/edu-atts/modification', [AllaskeresoTanulmanyController::class, 'updatesigned']);
        Route::delete('/jobseekers/profile/edu-atts/delete', [AllaskeresoTanulmanyController::class, 'destroySigned']);
        //allaskereso-tapasztalat
        Route::get('/jobseekers/profile/exps/v2', [AllaskeresoTapasztalatController::class, 'showsignedv2']);
        Route::put('/jobseekers/profile/exps/modification/v2', [AllaskeresoTapasztalatController::class, 'updatesignedv2']);
        Route::get('/jobseekers/profile/exps', [AllaskeresoTapasztalatController::class, 'showsigned']);
        Route::post('/jobseekers/profile/exps/new', [AllaskeresoTapasztalatController::class, 'storesigned']);
        Route::put('/jobseekers/profile/exps/modification', [AllaskeresoTapasztalatController::class, 'updatesigned']);
        Route::delete('/jobseekers/profile/exps/delete', [AllaskeresoTapasztalatController::class, 'destroySigned']);
        //allas-jelentkezo
        Route::get('/jobseekers/profile/applications', [AllasJelentkezoController::class, 'showsigned']);
        Route::post('/jobseekers/jobs/{allas_id}/apply', [AllasJelentkezoController::class, 'storesigned'])->whereNumber('allas_id');
    });
});
