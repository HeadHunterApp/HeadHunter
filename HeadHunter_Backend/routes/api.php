<?php

use App\Http\Controllers\AllasController;
use App\Http\Controllers\AllasIsmeretController;
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
Route::get('/jobs/all', [AllasController::class, 'shortAllasAll']);
Route::get('/jobs/{allas_id}', [AllasController::class, 'detailedAllas']);
//allas-kapcsolódók
Route::get('/jobs/{allas_id}/skills', [AllasIsmeretController::class, 'detailedAllasIsm']);
Route::get('/jobs/{allas_id}/languages', [AllasNyelvtudasController::class, 'detailedAllasNyelv']);
Route::get('/jobs/{allas_id}/edu-atts', [AllasVegzettsegController::class, 'detailedAllasVegz']);
Route::get('/jobs/{allas_id}/exps', [AllasTapasztalatController::class, 'detailedAllasTap']);


Route::middleware('auth')->group(function () {
    // bejelentkezett felhasználók

    //file feltöltés:
    Route::post('/file-upload', [FileController::class, 'store'])->name('file_store');

    Route::middleware(['admin'])->group(function () {
        //user
        Route::get('/user/all', [UserController::class, 'index']);
        Route::get('/user/{user_id}', [UserController::class, 'show']);
        Route::delete('/user/delete/{user_id}', [UserController::class, 'destroy']);
        //allas
        //csak az alap táblaadatok megjelenítése, id-k által meghívott adatok nélkül:
        Route::get('/jobs/basic/all', [AllasController::class, 'index']);
        Route::get('/jobs/basic/{allas_id}', [AllasController::class, 'show']);

        Route::post('/jobs/new', [AllasController::class, 'store']);
        Route::put('/jobs/modification/{allas_id}', [AllasController::class, 'update']);
        Route::delete('/jobs/delete/{allas_id}', [AllasController::class, 'destroy']);
        //allas-ismeret
        Route::get('/jobs/skills', [AllasIsmeretController::class, 'index']);
        Route::get('/jobs/{allas_id}/skills', [AllasIsmeretController::class, 'showallas']);
        Route::post('/jobs/skills/new', [AllasIsmeretController::class, 'store']);
        Route::put('/jobs/{allas_id}/skills/modification', [AllasIsmeretController::class, 'update']);
        Route::delete('/jobs/{allas_id}/skills/delete', [AllasIsmeretController::class, 'destroy']);
        //allas-nyelvtudas
        Route::get('/jobs/languages', [AllasNyelvtudasController::class, 'index']);
        Route::get('/jobs/{allas_id}/languages', [AllasNyelvtudasController::class, 'showallas']);
        Route::post('/jobs/languages/new', [AllasNyelvtudasController::class, 'store']);
        Route::put('/jobs/{allas_id}/languages/modification', [AllasNyelvtudasController::class, 'update']);
        Route::delete('/jobs/{allas_id}/languages/delete', [AllasNyelvtudasController::class, 'destroy']);
        //allas-vegzettseg
        Route::get('/jobs/edu-atts', [AllasVegzettsegController::class, 'index']);
        Route::get('/jobs/{allas_id}/edu-atts', [AllasVegzettsegController::class, 'showallas']);
        Route::post('/jobs/edu-atts/new', [AllasVegzettsegController::class, 'store']);
        Route::put('/jobs/{allas_id}/edu-atts/modification', [AllasVegzettsegController::class, 'update']);
        Route::delete('/jobs/{allas_id}/edu-atts/delete', [AllasVegzettsegController::class, 'destroy']);
        //allas-tapasztalat
        Route::get('/jobs/exps', [AllasTapasztalatController::class, 'index']);
        Route::get('/jobs/{allas_id}/exps', [AllasTapasztalatController::class, 'showallas']);
        Route::post('/jobs/exps/new', [AllasTapasztalatController::class, 'store']);
        Route::put('/jobs/{allas_id}/exps/modification', [AllasTapasztalatController::class, 'update']);
        Route::delete('/jobs/{allas_id}/exps/delete', [AllasTapasztalatController::class, 'destroy']);
        //fejvadasz
        Route::get('/headhunters/all', [FejvadaszController::class, 'index']);
        Route::get('/headhunters/{user_id}', [FejvadaszController::class, 'show']);
        Route::post('/headhunters/new', [FejvadaszController::class, 'store']);
        Route::put('/headhunters/modification/{user_id}', [FejvadaszController::class, 'update']);
        Route::delete('/headhunters/delete/{user_id}', [FejvadaszController::class, 'destroy']);
        //fejvadasz-terulet
        Route::get('/headhunters/fields', [FejvadaszTeruletController::class, 'index']);
        Route::get('/headhunters/{user_id}/fields', [FejvadaszTeruletController::class, 'showfejv']);
        Route::post('/headhunters/fields/new', [FejvadaszTeruletController::class, 'store']);
        Route::put('/headhunters/{user_id}/fields/modification', [FejvadaszTeruletController::class, 'update']);
        Route::delete('/headhunters/{user_id}/fields/delete', [FejvadaszTeruletController::class, 'destroy']);
        //allaskereso
        Route::get('/jobseekers/all', [AllaskeresoController::class, 'index']);
        Route::get('/jobseekers/{user_id}', [AllaskeresoController::class, 'show']);
        Route::post('/jobseekers/new', [AllaskeresoController::class, 'store']);
        Route::put('/jobseekers/modification/{user_id}', [AllaskeresoController::class, 'update']);
        Route::delete('/jobseekers/delete/{user_id}', [AllaskeresoController::class, 'destroy']);
        //allaskereso-ismeret
        Route::get('/jobseekers/skills', [AllaskeresoIsmeretController::class, 'index']);
        Route::get('/jobseekers/{user_id}/skills', [AllaskeresoIsmeretController::class, 'showallasker']);
        Route::post('/jobseekers/skills/new', [AllaskeresoIsmeretController::class, 'store']);
        Route::put('/jobseekers/{user_id}/skills/modification', [AllaskeresoIsmeretController::class, 'update']);
        Route::delete('/jobseekers/{user_id}/skills/delete', [AllaskeresoIsmeretController::class, 'destroy']);
        //allaskereso-nyelvtudas
        Route::get('/jobseekers/languages', [AllaskeresoNyelvtudasController::class, 'index']);
        Route::get('/jobseekers/{user_id}/languages', [AllaskeresoNyelvtudasController::class, 'showallasker']);
        Route::post('/jobseekers/languages/new', [AllaskeresoNyelvtudasController::class, 'store']);
        Route::put('/jobseekers/{user_id}/languages/modification', [AllaskeresoNyelvtudasController::class, 'update']);
        Route::delete('/jobseekers/{user_id}/languages/delete', [AllaskeresoNyelvtudasController::class, 'destroy']);
        //allaskereso-tanulmany
        Route::get('/jobseekers/edu-atts', [AllaskeresoTanulmanyController::class, 'index']);
        Route::get('/jobseekers/{user_id}/edu-atts', [AllaskeresoTanulmanyController::class, 'showallasker']);
        Route::post('/jobseekers/edu-atts/new', [AllaskeresoTanulmanyController::class, 'store']);
        Route::put('/jobseekers/{user_id}/edu-atts/modification', [AllaskeresoTanulmanyController::class, 'update']);
        Route::delete('/jobseekers/{user_id}/edu-atts/delete', [AllaskeresoTanulmanyController::class, 'destroy']);
        //allaskereso-tapasztalat
        Route::get('/jobseekers/exps', [AllaskeresoTapasztalatController::class, 'index']);
        Route::get('/jobseekers/{user_id}/exps', [AllaskeresoTapasztalatController::class, 'showallasker']);
        Route::post('/jobseekers/exps/new', [AllaskeresoTapasztalatController::class, 'store']);
        Route::put('/jobseekers/{user_id}/exps/modification', [AllaskeresoTapasztalatController::class, 'update']);
        Route::delete('/jobseekers/{user_id}/exps/delete', [AllaskeresoTapasztalatController::class, 'destroy']);
        //munkaltato
        Route::get('/employers/all', [MunkaltatoController::class, 'index']);
        Route::get('/employers/{munkaltato_id}', [MunkaltatoController::class, 'show']);
        Route::post('/employers/new', [MunkaltatoController::class, 'store']);
        Route::put('/employers/modification/{munkaltato_id}', [MunkaltatoController::class, 'update']);
        Route::delete('/employers/delete/{munkaltato_id}', [MunkaltatoController::class, 'destroy']);
        //terulet
        Route::get('/fields/all', [TeruletController::class, 'index']);
        Route::get('/fields/{terulet_id}', [TeruletController::class, 'show']);
        Route::post('/fields/new', [TeruletController::class, 'store]']);
        Route::put('/fields/modification/{terulet_id}', [TeruletController::class, 'update']);
        Route::delete('/fields/delete/{terulet_id}', [TeruletController::class, 'destroy']);
        //pozicio
        Route::get('/positions/all', [PozicioController::class, 'index']);
        Route::get('/positions/{pozkod}', [PozicioController::class], 'show');
        Route::post('/positions/new', [PozicioController::class], 'store');
        Route::put('/positions/modification/{pozkod}', [PozicioController::class], 'update');
        Route::delete('/positions/delete/{pozkod}', [PozicioController::class, 'destroy']);
        //szakmai ismeret
        Route::get('/skills/all', [SzakmaiIsmeretController::class, 'index']);
        Route::get('/skills/{ismeret_id}', [SzakmaiIsmeretController::class, 'show']);
        Route::post('/skills/new', [SzakmaiIsmeretController::class, 'store']);
        Route::put('/skills/modification/{ismeret_id}', [SzakmaiIsmeretController::class, 'update']);
        Route::delete('/skills/delete/{ismeret_id}', [SzakmaiIsmeretController::class, 'destroy']);
        //vegzettseg
        Route::get('/edu-attainments/all', [VegzettsegController::class, 'index']);
        Route::get('/edu-attainments/{vegzettseg_id}', [VegzettsegController::class, 'show']);
        //nyelvtudas
        Route::get('/languages/all', [NyelvtudasController::class, 'index']);
        Route::get('/languages/{nyelvkod}', [NyelvtudasController::class, 'show']);
        Route::post('/languages/new', [NyelvtudasController::class, 'store']);
        Route::put('/languages/modification/{nyelvkod}', [NyelvtudasController::class, 'update']);
        Route::delete('/languages/delete/{nyelvkod}', [NyelvtudasController::class, 'destroy']);
        //tapasztalat_ido
        Route::get('/experiences/all', [NyelvtudasController::class, 'index']);
        Route::get('/experiences/{tapasztalat_id}', [NyelvtudasController::class, 'show']);
        //lekérdezések:

    });
    Route::middleware(['headhunter'])->group(function () {
        //allas
        Route::get('/jobs/all', [AllasController::class, 'shortAllasAll']);
        Route::get('/jobs/{allas_id}', [AllasController::class, 'detailedAllas']);
        Route::post('/jobs/new', [AllasController::class, 'store']);
        Route::put('/jobs/modification/{allas_id}', [AllasController::class, 'update']);
        //allas-ismeret
        Route::get('/jobs/{allas_id}/skills', [AllasIsmeretController::class, 'detailedAllasIsm']);
        Route::post('/jobs/skills/new', [AllasIsmeretController::class, 'store']);
        Route::put('/jobs/{allas_id}/skills/modification', [AllasIsmeretController::class, 'update']);
        Route::delete('/jobs/{allas_id}/skills/delete', [AllasIsmeretController::class, 'destroy']);
        //allas-nyelvtudas
        Route::get('/jobs/{allas_id}/languages', [AllasNyelvtudasController::class, 'detailedAllasNyelv']);
        Route::post('/jobs/languages/new', [AllasNyelvtudasController::class, 'store']);
        Route::put('/jobs/{allas_id}/languages/modification', [AllasNyelvtudasController::class, 'update']);
        Route::delete('/jobs/{allas_id}/languages/delete', [AllasNyelvtudasController::class, 'destroy']);
        //allas-vegzettseg
        Route::get('/jobs/{allas_id}/edu-atts', [AllasVegzettsegController::class, 'detailedAllasVegz']);
        Route::post('/jobs/edu-atts/new', [AllasVegzettsegController::class, 'store']);
        Route::put('/jobs/{allas_id}/edu-atts/modification', [AllasVegzettsegController::class, 'update']);
        Route::delete('/jobs/{allas_id}/edu-atts/delete', [AllasVegzettsegController::class, 'destroy']);
        //allas-tapasztalat
        Route::get('/jobs/{allas_id}/exps', [AllasTapasztalatController::class, 'detailedAllasTap']);
        Route::post('/jobs/exps/new', [AllasTapasztalatController::class, 'store']);
        Route::put('/jobs/{allas_id}/exps/modification', [AllasTapasztalatController::class, 'update']);
        Route::delete('/jobs/{allas_id}/exps/delete', [AllasTapasztalatController::class, 'destroy']);
        //fejvadasz
        Route::get('/headhunters/profile', [FejvadaszController::class, 'showsigned']);
        Route::put('/headhunters/profile/modification', [FejvadaszController::class, 'updatesigned']);
        Route::post('/headhunters/profile/image', [FejvadaszController::class, 'uploadImage']);
        //fejvadasz-terulet
        Route::get('/headhunters/profile/fields', [FejvadaszTeruletController::class, 'showsigned']);
        //allaskereso
        Route::get('/jobseekers/all', [AllaskeresoController::class, 'index']);
        Route::get('/jobseekers/{user_id}', [AllaskeresoController::class, 'show']);
        //allaskereso-kapcsolódók
        Route::get('/jobseekers/{user_id}/skills', [AllaskeresoIsmeretController::class, 'showallasker']);
        Route::get('/jobseekers/{user_id}/languages', [AllaskeresoNyelvtudasController::class, 'showallasker']);
        Route::get('/jobseekers/{user_id}/edu-atts', [AllaskeresoTanulmanyController::class, 'showallasker']);
        Route::get('/jobseekers/{user_id}/exps', [AllaskeresoTapasztalatController::class, 'showallasker']);
        //munkaltato
        Route::get('/employers/all', [MunkaltatoController::class, 'index']);
        Route::get('/employers/{munkaltato_id}', [MunkaltatoController::class, 'show']);
        Route::post('/employers/new', [MunkaltatoController::class, 'store']);
        Route::put('/employers/modification/{munkaltato_id}', [MunkaltatoController::class, 'update']);
        //terulet
        Route::get('/fields/all', [TeruletController::class, 'index']);
        Route::get('/fields/{terulet_id}', [TeruletController::class, 'show']);
        //pozicio
        Route::get('/positions/all', [PozicioController::class, 'index']);
        Route::get('/positions/{pozkod}', [PozicioController::class], 'show');
        //szakmai ismeret
        Route::get('/skills/all', [SzakmaiIsmeretController::class, 'index']);
        Route::get('/skills/{ismeret_id}', [SzakmaiIsmeretController::class, 'show']);
        //vegzettseg
        Route::get('/edu-attainments/all', [VegzettsegController::class, 'index']);
        Route::get('/edu-attainments/{vegzettseg_id}', [VegzettsegController::class, 'show']);
        //nyelvtudas
        Route::get('/languages/all', [NyelvtudasController::class, 'index']);
        Route::get('/languages/{nyelvkod}', [NyelvtudasController::class, 'show']);
        //tapasztalat_ido
        Route::get('/experiences/all', [NyelvtudasController::class, 'index']);
        Route::get('/experiences/{tapasztalat_id}', [NyelvtudasController::class, 'show']);
        //lekérdezések:

    });
    Route::middleware(['jobseeker'])->group(function () {
        //allas
        Route::get('/jobs/all', [AllasController::class, 'shortAllasAll']);
        Route::get('/jobs/{allas_id}', [AllasController::class, 'detailedAllas']);
        //allas-kapcsolódók
        Route::get('/jobs/{allas_id}/skills', [AllasIsmeretController::class, 'detailedAllasIsm']);
        Route::get('/jobs/{allas_id}/languages', [AllasNyelvtudasController::class, 'detailedAllasNyelv']);
        Route::get('/jobs/{allas_id}/edu-atts', [AllasVegzettsegController::class, 'detailedAllasVegz']);
        Route::get('/jobs/{allas_id}/exps', [AllasTapasztalatController::class, 'detailedAllasTap']);
        //allaskereso
        Route::get('/jobseekers/profile', [AllaskeresoController::class, 'showsigned']);
        Route::put('/jobseekers/profile/modification', [AllaskeresoController::class, 'updatesigned']);
        //allaskereso-ismeret
        Route::get('/jobseekers/profile/skills', [AllaskeresoIsmeretController::class, 'showsigned']);
        Route::post('/jobseekers/skills/new', [AllaskeresoIsmeretController::class, 'store']);
        Route::put('/jobseekers/profile/skills/modification', [AllaskeresoIsmeretController::class, 'updatesigned']);
        //allaskereso-nyelvtudas
        Route::get('/jobseekers/profile/languages', [AllaskeresoNyelvtudasController::class, 'showsigned']);
        Route::post('/jobseekers/languages/new', [AllaskeresoNyelvtudasController::class, 'store']);
        Route::put('/jobseekers/profile/languages/modification', [AllaskeresoNyelvtudasController::class, 'updatesigned']);
        //allaskereso-tanulmany
        Route::get('/jobseekers/profile/edu-atts', [AllaskeresoTanulmanyController::class, 'showsigned']);
        Route::post('/jobseekers/edu-atts/new', [AllaskeresoTanulmanyController::class, 'store']);
        Route::put('/jobseekers/profile/edu-atts/modification', [AllaskeresoTanulmanyController::class, 'updatesigned']);
        //allaskereso-tapasztalat
        Route::get('/jobseekers/profile/exps', [AllaskeresoTapasztalatController::class, 'showsigned']);
        Route::post('/jobseekers/exps/new', [AllaskeresoTapasztalatController::class, 'store']);
        Route::put('/jobseekers/profile/exps/modification', [AllaskeresoTapasztalatController::class, 'updatesigned']);
        //terulet
        Route::get('/fields/all', [TeruletController::class, 'index']);
        Route::get('/fields/{terulet_id}', [TeruletController::class, 'show']);
        //pozicio
        Route::get('/positions/all', [PozicioController::class, 'index']);
        Route::get('/positions/{pozkod}', [PozicioController::class], 'show');
        //szakmai ismeret
        Route::get('/skills/all', [SzakmaiIsmeretController::class, 'index']);
        Route::get('/skills/{ismeret_id}', [SzakmaiIsmeretController::class, 'show']);
        //vegzettseg
        Route::get('/edu-attainments/all', [VegzettsegController::class, 'index']);
        Route::get('/edu-attainments/{vegzettseg_id}', [VegzettsegController::class, 'show']);
        //nyelvtudas
        Route::get('/languages/all', [NyelvtudasController::class, 'index']);
        Route::get('/languages/{nyelvkod}', [NyelvtudasController::class, 'show']);
        //tapasztalat_ido
        Route::get('/experiences/all', [NyelvtudasController::class, 'index']);
        Route::get('/experiences/{tapasztalat_id}', [NyelvtudasController::class, 'show']);
        //lekérdezések:

    });
});



