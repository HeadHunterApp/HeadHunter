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

//álláskereső oldalhoz route bejelentkezés nélkül:
//allas
Route::get('/guest/jobs/all', [AllasController::class, 'shortAllasAll']);
Route::get('/guest/jobs/{allas_id}', [AllasController::class, 'detailedAllas']);
//allas-kapcsolódók
Route::get('/guest/jobs/{allas_id}/skills', [AllasIsmeretController::class, 'detailedAllasIsm']);
Route::get('/guest/jobs/{allas_id}/languages', [AllasNyelvtudasController::class, 'detailedAllasNyelv']);
Route::get('/guest/jobs/{allas_id}/edu-atts', [AllasVegzettsegController::class, 'detailedAllasVegz']);
Route::get('/guest/jobs/{allas_id}/exps', [AllasTapasztalatController::class, 'detailedAllasTap']);

Route::middleware('auth')->group(function () {
    // bejelentkezett felhasználók
    //Route::post('/hunter/headhunters/profile/image', [FejvadaszController::class, 'uploadImage']);
    Route::post('/user/profile/image', [UserController::class, 'uploadImage']);

    Route::middleware(['admin'])->group(function () {
        //user
        Route::get('/admin/user/all', [UserController::class, 'index']);
        Route::get('/admin/user/{user_id}', [UserController::class, 'show']);
        Route::delete('/admin/user/delete/{user_id}', [UserController::class, 'destroy']);
        //allas
       //Route::get('/admin/jobs/all', [AllasController::class, 'index']);
       //Route::get('/admin/jobs/{allas_id}', [AllasController::class, 'show']);
        Route::get('/admin/jobs/all', [AllasController::class, 'shortAllasAll']);
        Route::get('/admin/jobs/{allas_id}', [AllasController::class, 'detailedAllas']);
        Route::post('/admin/jobs/new', [AllasController::class, 'store']);
        Route::put('/admin/jobs/modification/{allas_id}', [AllasController::class, 'update']);
        Route::delete('/admin/jobs/delete/{allas_id}', [AllasController::class, 'destroy']);
        //allas-ismeret
        Route::get('/admin/jobs/skills', [AllasIsmeretController::class, 'index']);
        Route::get('/admin/jobs/{allas_id}/skills', [AllasIsmeretController::class, 'showallas']);
        Route::post('/admin/jobs/skills/new', [AllasIsmeretController::class, 'store']);
        Route::put('/admin/jobs/{allas_id}/skills/modification', [AllasIsmeretController::class, 'update']);
        Route::delete('/admin/jobs/{allas_id}/skills/delete', [AllasIsmeretController::class, 'destroy']);
        //allas-nyelvtudas
        Route::get('/admin/jobs/languages', [AllasNyelvtudasController::class, 'index']);
        Route::get('/admin/jobs/{allas_id}/languages', [AllasNyelvtudasController::class, 'showallas']);
        Route::post('/admin/jobs/languages/new', [AllasNyelvtudasController::class, 'store']);
        Route::put('/admin/jobs/{allas_id}/languages/modification', [AllasNyelvtudasController::class, 'update']);
        Route::delete('/admin/jobs/{allas_id}/languages/delete', [AllasNyelvtudasController::class, 'destroy']);
        //allas-vegzettseg
        Route::get('/admin/jobs/edu-atts', [AllasVegzettsegController::class, 'index']);
        Route::get('/admin/jobs/{allas_id}/edu-atts', [AllasVegzettsegController::class, 'showallas']);
        Route::post('/admin/jobs/edu-atts/new', [AllasVegzettsegController::class, 'store']);
        Route::put('/admin/jobs/{allas_id}/edu-atts/modification', [AllasVegzettsegController::class, 'update']);
        Route::delete('/admin/jobs/{allas_id}/edu-atts/delete', [AllasVegzettsegController::class, 'destroy']);
        //allas-tapasztalat
        Route::get('/admin/jobs/exps', [AllasTapasztalatController::class, 'index']);
        Route::get('/admin/jobs/{allas_id}/exps', [AllasTapasztalatController::class, 'showallas']);
        Route::post('/admin/jobs/exps/new', [AllasTapasztalatController::class, 'store']);
        Route::put('/admin/jobs/{allas_id}/exps/modification', [AllasTapasztalatController::class, 'update']);
        Route::delete('/admin/jobs/{allas_id}/exps/delete', [AllasTapasztalatController::class, 'destroy']);
        //fejvadasz
        Route::get('/admin/headhunters/all', [FejvadaszController::class, 'index']);
        Route::get('/admin/headhunters/{user_id}', [FejvadaszController::class, 'show']);
        Route::post('/admin/headhunters/new', [FejvadaszController::class, 'store']);
        Route::put('/admin/headhunters/modification/{user_id}', [FejvadaszController::class, 'update']);
        Route::delete('/admin/headhunters/delete/{user_id}', [FejvadaszController::class, 'destroy']);
        //fejvadasz-terulet
        Route::get('/admin/headhunters/fields', [FejvadaszTeruletController::class, 'index']);
        Route::get('/admin/headhunters/{user_id}/fields', [FejvadaszTeruletController::class, 'showfejv']);
        Route::post('/admin/headhunters/fields/new', [FejvadaszTeruletController::class, 'store']);
        Route::put('/admin/headhunters/{user_id}/fields/modification', [FejvadaszTeruletController::class, 'update']);
        Route::delete('/admin/headhunters/{user_id}/fields/delete', [FejvadaszTeruletController::class, 'destroy']);
        //allaskereso
        Route::get('/admin/jobseekers/all', [AllaskeresoController::class, 'index']);
        Route::get('/admin/jobseekers/{user_id}', [AllaskeresoController::class, 'show']);
        Route::post('/admin/jobseekers/new', [AllaskeresoController::class, 'store']);
        Route::put('/admin/jobseekers/modification/{user_id}', [AllaskeresoController::class, 'update']);
        Route::delete('/admin/jobseekers/delete/{user_id}', [AllaskeresoController::class, 'destroy']);
        //allaskereso-ismeret
        Route::get('/admin/jobseekers/skills', [AllaskeresoIsmeretController::class, 'index']);
        Route::get('/admin/jobseekers/{user_id}/skills', [AllaskeresoIsmeretController::class, 'showallasker']);
        Route::post('/admin/jobseekers/skills/new', [AllaskeresoIsmeretController::class, 'store']);
        Route::put('/admin/jobseekers/{user_id}/skills/modification', [AllaskeresoIsmeretController::class, 'update']);
        Route::delete('/admin/jobseekers/{user_id}/skills/delete', [AllaskeresoIsmeretController::class, 'destroy']);
        //allaskereso-nyelvtudas
        Route::get('/admin/jobseekers/languages', [AllaskeresoNyelvtudasController::class, 'index']);
        Route::get('/admin/jobseekers/{user_id}/languages', [AllaskeresoNyelvtudasController::class, 'showallasker']);
        Route::post('/admin/jobseekers/languages/new', [AllaskeresoNyelvtudasController::class, 'store']);
        Route::put('/admin/jobseekers/{user_id}/languages/modification', [AllaskeresoNyelvtudasController::class, 'update']);
        Route::delete('/admin/jobseekers/{user_id}/languages/delete', [AllaskeresoNyelvtudasController::class, 'destroy']);
        //allaskereso-tanulmany
        Route::get('/admin/jobseekers/edu-atts', [AllaskeresoTanulmanyController::class, 'index']);
        Route::get('/admin/jobseekers/{user_id}/edu-atts', [AllaskeresoTanulmanyController::class, 'showallasker']);
        Route::post('/admin/jobseekers/edu-atts/new', [AllaskeresoTanulmanyController::class, 'store']);
        Route::put('/admin/jobseekers/{user_id}/edu-atts/modification', [AllaskeresoTanulmanyController::class, 'update']);
        Route::delete('/admin/jobseekers/{user_id}/edu-atts/delete', [AllaskeresoTanulmanyController::class, 'destroy']);
        //allaskereso-tapasztalat
        Route::get('/admin/jobseekers/exps', [AllaskeresoTapasztalatController::class, 'index']);
        Route::get('/admin/jobseekers/{user_id}/exps', [AllaskeresoTapasztalatController::class, 'showallasker']);
        Route::post('/admin/jobseekers/exps/new', [AllaskeresoTapasztalatController::class, 'store']);
        Route::put('/admin/jobseekers/{user_id}/exps/modification', [AllaskeresoTapasztalatController::class, 'update']);
        Route::delete('/admin/jobseekers/{user_id}/exps/delete', [AllaskeresoTapasztalatController::class, 'destroy']);
        //munkaltato
        Route::get('/admin/employers/all', [MunkaltatoController::class, 'index']);
        Route::get('/admin/employers/{munkaltato_id}', [MunkaltatoController::class, 'show']);
        Route::post('/admin/employers/new', [MunkaltatoController::class, 'store']);
        Route::put('/admin/employers/modification/{munkaltato_id}', [MunkaltatoController::class, 'update']);
        Route::delete('/admin/employers/delete/{munkaltato_id}', [MunkaltatoController::class, 'destroy']);
        //terulet
        Route::get('/admin/fields/all', [TeruletController::class, 'index']);
        Route::get('/admin/fields/{terulet_id}', [TeruletController::class, 'show']);
        Route::post('/admin/fields/new', [TeruletController::class, 'store]']);
        Route::put('/admin/fields/modification/{terulet_id}', [TeruletController::class, 'update']);
        Route::delete('/admin/fields/delete/{terulet_id}', [TeruletController::class, 'destroy']);
        //pozicio
        Route::get('/admin/positions/all', [PozicioController::class, 'index']);
        Route::get('/admin/positions/{pozkod}', [PozicioController::class], 'show');
        Route::post('/admin/positions/new', [PozicioController::class], 'store');
        Route::put('/admin/positions/modification/{pozkod}', [PozicioController::class], 'update');
        Route::delete('/admin/positions/delete/{pozkod}', [PozicioController::class, 'destroy']);
        //szakmai ismeret
        Route::get('/admin/skills/all', [SzakmaiIsmeretController::class, 'index']);
        Route::get('/admin/skills/{ismeret_id}', [SzakmaiIsmeretController::class, 'show']);
        Route::post('/admin/skills/new', [SzakmaiIsmeretController::class, 'store']);
        Route::put('/admin/skills/modification/{ismeret_id}', [SzakmaiIsmeretController::class, 'update']);
        Route::delete('/admin/skills/delete/{ismeret_id}', [SzakmaiIsmeretController::class, 'destroy']);
        //vegzettseg
        Route::get('/admin/edu-attainments/all', [VegzettsegController::class, 'index']);
        Route::get('/admin/edu-attainments/{vegzettseg_id}', [VegzettsegController::class, 'show']);
        //nyelvtudas
        Route::get('/admin/languages/all', [NyelvtudasController::class, 'index']);
        Route::get('/admin/languages/{nyelvkod}', [NyelvtudasController::class, 'show']);
        Route::post('/admin/languages/new', [NyelvtudasController::class, 'store']);
        Route::put('/admin/languages/modification/{nyelvkod}', [NyelvtudasController::class, 'update']);
        Route::delete('/admin/languages/delete/{nyelvkod}', [NyelvtudasController::class, 'destroy']);
        //tapasztalat_ido
        Route::get('/admin/experiences/all', [NyelvtudasController::class, 'index']);
        Route::get('/admin/experiences/{tapasztalat_id}', [NyelvtudasController::class, 'show']);
        //file feltöltés:
        Route::post('/admin/file-upload', [FileController::class, 'store'])->name('file_store');
        //lekérdezések:

    });
    Route::middleware(['headhunter'])->group(function () {
        //allas
        Route::get('/hunter/jobs/all', [AllasController::class, 'shortAllasAll']);
        Route::get('/hunter/jobs/{allas_id}', [AllasController::class, 'detailedAllas']);
        Route::post('/hunter/jobs/new', [AllasController::class, 'store']);
        Route::put('/hunter/jobs/modification/{allas_id}', [AllasController::class, 'update']);
        //allas-ismeret
        Route::get('/hunter/jobs/{allas_id}/skills', [AllasIsmeretController::class, 'detailedAllasIsm']);
        Route::post('/hunter/jobs/skills/new', [AllasIsmeretController::class, 'store']);
        Route::put('/hunter/jobs/{allas_id}/skills/modification', [AllasIsmeretController::class, 'update']);
        Route::delete('/hunter/jobs/{allas_id}/skills/delete', [AllasIsmeretController::class, 'destroy']);
        //allas-nyelvtudas
        Route::get('/hunter/jobs/{allas_id}/languages', [AllasNyelvtudasController::class, 'detailedAllasNyelv']);
        Route::post('/hunter/jobs/languages/new', [AllasNyelvtudasController::class, 'store']);
        Route::put('/hunter/jobs/{allas_id}/languages/modification', [AllasNyelvtudasController::class, 'update']);
        Route::delete('/hunter/jobs/{allas_id}/languages/delete', [AllasNyelvtudasController::class, 'destroy']);
        //allas-vegzettseg
        Route::get('/hunter/jobs/{allas_id}/edu-atts', [AllasVegzettsegController::class, 'detailedAllasVegz']);
        Route::post('/hunter/jobs/edu-atts/new', [AllasVegzettsegController::class, 'store']);
        Route::put('/hunter/jobs/{allas_id}/edu-atts/modification', [AllasVegzettsegController::class, 'update']);
        Route::delete('/hunter/jobs/{allas_id}/edu-atts/delete', [AllasVegzettsegController::class, 'destroy']);
        //allas-tapasztalat
        Route::get('/hunter/jobs/{allas_id}/exps', [AllasTapasztalatController::class, 'detailedAllasTap']);
        Route::post('/hunter/jobs/exps/new', [AllasTapasztalatController::class, 'store']);
        Route::put('/hunter/jobs/{allas_id}/exps/modification', [AllasTapasztalatController::class, 'update']);
        Route::delete('/hunter/jobs/{allas_id}/exps/delete', [AllasTapasztalatController::class, 'destroy']);
        //fejvadasz
        Route::get('/hunter/headhunters/profile', [FejvadaszController::class, 'showsigned']);
        Route::get('/hunter/headhunters/profile/v2', [FejvadaszController::class, 'showsignedv2']);
        Route::put('/hunter/headhunters/profile/modification', [FejvadaszController::class, 'updatesigned']);
        Route::put('/hunter/headhunters/profile/modification/v2', [FejvadaszController::class, 'updatesignedv2']);
        //fejvadasz-terulet
        Route::get('/hunter/headhunters/profile/fields', [FejvadaszTeruletController::class, 'showsigned']);
        //allaskereso
        Route::get('/hunter/jobseekers/all', [AllaskeresoController::class, 'index']);
        Route::get('/hunter/jobseekers/{user_id}', [AllaskeresoController::class, 'show']);
        //allaskereso-kapcsolódók
        Route::get('/hunter/jobseekers/{user_id}/skills', [AllaskeresoIsmeretController::class, 'showallasker']);
        Route::get('/hunter/jobseekers/{user_id}/languages', [AllaskeresoNyelvtudasController::class, 'showallasker']);
        Route::get('/hunter/jobseekers/{user_id}/edu-atts', [AllaskeresoTanulmanyController::class, 'showallasker']);
        Route::get('/hunter/jobseekers/{user_id}/exps', [AllaskeresoTapasztalatController::class, 'showallasker']);
        //munkaltato
        Route::get('/hunter/employers/all', [MunkaltatoController::class, 'index']);
        Route::get('/hunter/employers/{munkaltato_id}', [MunkaltatoController::class, 'show']);
        Route::post('/hunter/employers/new', [MunkaltatoController::class, 'store']);
        Route::put('/hunter/employers/modification/{munkaltato_id}', [MunkaltatoController::class, 'update']);
        //terulet
        Route::get('/hunter/fields/all', [TeruletController::class, 'index']);
        Route::get('/hunter/fields/{terulet_id}', [TeruletController::class, 'show']);
        //pozicio
        Route::get('/hunter/positions/all', [PozicioController::class, 'index']);
        Route::get('/hunter/positions/{pozkod}', [PozicioController::class], 'show');
        //szakmai ismeret
        Route::get('/hunter/skills/all', [SzakmaiIsmeretController::class, 'index']);
        Route::get('/hunter/skills/{ismeret_id}', [SzakmaiIsmeretController::class, 'show']);
        //vegzettseg
        Route::get('/hunter/edu-attainments/all', [VegzettsegController::class, 'index']);
        Route::get('/hunter/edu-attainments/{vegzettseg_id}', [VegzettsegController::class, 'show']);
        //nyelvtudas
        Route::get('/hunter/languages/all', [NyelvtudasController::class, 'index']);
        Route::get('/hunter/languages/{nyelvkod}', [NyelvtudasController::class, 'show']);
        //tapasztalat_ido
        Route::get('/hunter/experiences/all', [NyelvtudasController::class, 'index']);
        Route::get('/hunter/experiences/{tapasztalat_id}', [NyelvtudasController::class, 'show']);
        //file feltöltés:
        Route::post('/hunter/file-upload', [FileController::class, 'store'])->name('file_store');
        //lekérdezések:

    });
    Route::middleware(['jobseeker'])->group(function () {
        //allas
        Route::get('/seeker/jobs/all', [AllasController::class, 'shortAllasAll']);
        Route::get('/seeker/jobs/{allas_id}', [AllasController::class, 'detailedAllas']);
        //allas-kapcsolódók
        Route::get('/seeker/jobs/{allas_id}/skills', [AllasIsmeretController::class, 'detailedAllasIsm']);
        Route::get('/seeker/jobs/{allas_id}/languages', [AllasNyelvtudasController::class, 'detailedAllasNyelv']);
        Route::get('/seeker/jobs/{allas_id}/edu-atts', [AllasVegzettsegController::class, 'detailedAllasVegz']);
        Route::get('/seeker/jobs/{allas_id}/exps', [AllasTapasztalatController::class, 'detailedAllasTap']);
        //allaskereso
        Route::get('/seeker/jobseekers/profile', [AllaskeresoController::class, 'showsigned']);
        Route::get('/seeker/jobseekers/profile/v2', [AllaskeresoController::class, 'showsignedv2']);
        Route::put('/seeker/jobseekers/profile/modification', [AllaskeresoController::class, 'updatesigned']);
        Route::put('/seeker/jobseekers/profile/modification/v2', [AllaskeresoController::class, 'updatesignedv2']);
        //allaskereso-ismeret
        Route::get('/seeker/jobseekers/profile/skills', [AllaskeresoIsmeretController::class, 'showsigned']);
        Route::post('/seeker/jobseekers/skills/new', [AllaskeresoIsmeretController::class, 'store']);
        Route::put('/seeker/jobseekers/profile/skills/modification', [AllaskeresoIsmeretController::class, 'updatesigned']);
        //allaskereso-nyelvtudas
        Route::get('/seeker/jobseekers/profile/languages', [AllaskeresoNyelvtudasController::class, 'showsigned']);
        Route::get('/seeker/jobseekers/profile/languages/v2', [AllaskeresoNyelvtudasController::class, 'showsignedv2']);
        Route::post('/seeker/jobseekers/languages/new', [AllaskeresoNyelvtudasController::class, 'store']);
        Route::put('/seeker/jobseekers/profile/languages/modification', [AllaskeresoNyelvtudasController::class, 'updatesigned']);
        Route::put('/seeker/jobseekers/profile/languages/modification/v2', [AllaskeresoNyelvtudasController::class, 'updatesignedv2']);
        //allaskereso-tanulmany
        Route::get('/seeker/jobseekers/profile/edu-atts', [AllaskeresoTanulmanyController::class, 'showsigned']);
        Route::get('/seeker/jobseekers/profile/edu-atts/v2', [AllaskeresoTanulmanyController::class, 'showsignedv2']);
        Route::post('/seeker/jobseekers/edu-atts/new', [AllaskeresoTanulmanyController::class, 'store']);
        Route::put('/seeker/jobseekers/profile/edu-atts/modification', [AllaskeresoTanulmanyController::class, 'updatesigned']);
        Route::put('/seeker/jobseekers/profile/edu-atts/modification/v2', [AllaskeresoTanulmanyController::class, 'updatesignedv2']);
        //allaskereso-tapasztalat
        Route::get('/seeker/jobseekers/profile/exps', [AllaskeresoTapasztalatController::class, 'showsigned']);
        Route::get('/seeker/jobseekers/profile/exps/v2', [AllaskeresoTapasztalatController::class, 'showsignedv2']);
        Route::post('/seeker/jobseekers/exps/new', [AllaskeresoTapasztalatController::class, 'store']);
        Route::put('/seeker/jobseekers/profile/exps/modification', [AllaskeresoTapasztalatController::class, 'updatesigned']);
        Route::put('/seeker/jobseekers/profile/exps/modification/v2', [AllaskeresoTapasztalatController::class, 'updatesignedv2']);
        //terulet
        Route::get('/seeker/fields/all', [TeruletController::class, 'index']);
        Route::get('/seeker/fields/{terulet_id}', [TeruletController::class, 'show']);
        //pozicio
        Route::get('/seeker/positions/all', [PozicioController::class, 'index']);
        Route::get('/seeker/positions/{pozkod}', [PozicioController::class], 'show');
        //szakmai ismeret
        Route::get('/seeker/skills/all', [SzakmaiIsmeretController::class, 'index']);
        Route::get('/seeker/skills/{ismeret_id}', [SzakmaiIsmeretController::class, 'show']);
        //vegzettseg
        Route::get('/seeker/edu-attainments/all', [VegzettsegController::class, 'index']);
        Route::get('/seeker/edu-attainments/{vegzettseg_id}', [VegzettsegController::class, 'show']);
        //nyelvtudas
        Route::get('/seeker/languages/all', [NyelvtudasController::class, 'index']);
        Route::get('/seeker/languages/{nyelvkod}', [NyelvtudasController::class, 'show']);
        //tapasztalat_ido
        Route::get('/seeker/experiences/all', [NyelvtudasController::class, 'index']);
        Route::get('/seeker/experiences/{tapasztalat_id}', [NyelvtudasController::class, 'show']);
        //file feltöltés:
        Route::post('/seeker/file-upload', [FileController::class, 'store'])->name('file_store');
        //lekérdezések:

    });
});



