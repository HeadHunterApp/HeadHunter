<?php

use App\Http\Controllers\AllasController;
use App\Http\Controllers\AllaskeresoController;
use App\Http\Controllers\FejvadaszController;
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

Route::get('/dashboard', function () {
    return '{}';
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // bejelentkezett felhasználók

    Route::middleware(['admin'])->group(function () {
        //user
        Route::get('/admin/user/all', [UserController::class, 'index']);
        Route::get('/admin/user/{user_id}', [UserController::class, 'show']);
        Route::delete('/admin/user/delete/{user_id}', [UserController::class, 'destroy']);
        //allas
        Route::get('/admin/jobs/all', [AllasController::class, 'index']);
        Route::get('/admin/jobs/{allas_id}', [AllasController::class, 'show']);
        Route::post('/admin/jobs/new', [AllasController::class, 'store']);
        Route::put('/admin/jobs/modification/{allas_id}', [AllasController::class, 'update']);
        Route::delete('/admin/jobs/delete/{allas_id}', [AllasController::class, 'destroy']);
        //fejvadasz
        Route::get('/admin/headhunters/all', [FejvadaszController::class, 'index']);
        Route::get('/admin/headhunters/{user_id}', [FejvadaszController::class, 'show']);
        Route::post('/admin/headhunters/new', [FejvadaszController::class, 'store']);
        Route::put('/admin/headhunters/modification/{user_id}', [FejvadaszController::class, 'update']);
        Route::delete('/admin/headhunters/delete/{user_id}', [FejvadaszController::class, 'destroy']);
        //allaskereso
        Route::get('/admin/jobseekers/all', [AllaskeresoController::class, 'index']);
        Route::get('/admin/jobseekers/{user_id}', [AllaskeresoController::class, 'show']);
        Route::post('/admin/jobseekers/new', [AllaskeresoController::class, 'store']);
        Route::put('/admin/jobseekers/modification/{user_id}', [AllaskeresoController::class, 'update']);
        Route::delete('/admin/jobseekers/delete/{user_id}', [AllaskeresoController::class, 'destroy']);
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
        Route::get('/admin/experience/all', [NyelvtudasController::class, 'index']);
        Route::get('/admin/experience/{tapasztalat_id}', [NyelvtudasController::class, 'show']);
        //lekérdezések:

    });
    Route::middleware(['headhunter'])->group(function () {
        //allas
        Route::get('/hunter/jobs/all', [AllasController::class, 'index']);
        Route::get('/hunter/jobs/{allas_id}', [AllasController::class, 'show']);
        Route::post('/hunter/jobs/new', [AllasController::class, 'store']);
        Route::put('/hunter/jobs/modification/{allas_id}', [AllasController::class, 'update']);
        //fejvadasz
        Route::get('/hunter/headhunters/profile', [FejvadaszController::class, 'showsigned']);
        Route::put('/hunter/headhunters/profile/modification', [FejvadaszController::class, 'updatesigned']);
        //allaskereso
        Route::get('/hunter/jobseekers/all', [AllaskeresoController::class, 'index']);
        Route::get('/hunter/jobseekers/{user_id}', [AllaskeresoController::class, 'show']);
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
        Route::get('/hunter/experience/all', [NyelvtudasController::class, 'index']);
        Route::get('/hunter/experience/{tapasztalat_id}', [NyelvtudasController::class, 'show']);
        //lekérdezések:

    });
    Route::middleware(['jobseeker'])->group(function () {
        //allas
        Route::get('/seeker/jobs/all', [AllasController::class, 'index']);
        Route::get('/seeker/jobs/{allas_id}', [AllasController::class, 'show']);
        //allaskereso
        Route::get('/seeker/jobseekers/profile', [AllaskeresoController::class, 'showsigned']);
        Route::post('/seeker/jobseekers/new', [AllaskeresoController::class, 'store']);
        Route::put('/seeker/jobseekers/profile/modification', [AllaskeresoController::class, 'updatesigned']);
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
        Route::get('/seeker/experience/all', [NyelvtudasController::class, 'index']);
        Route::get('/seeker/experience/{tapasztalat_id}', [NyelvtudasController::class, 'show']);
        //lekérdezések:

    });
});



