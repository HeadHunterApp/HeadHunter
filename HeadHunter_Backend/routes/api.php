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
    });
    Route::middleware(['headhunter'])->group(function () {
        //allas
        Route::get('/hunter/jobs/all', [AllasController::class, 'index']);
        Route::get('/hunter/jobs/{allas_id}', [AllasController::class, 'show']);
        Route::post('/hunter/jobs/new', [AllasController::class, 'store']);
        Route::put('/hunter/jobs/modification/{allas_id}', [AllasController::class, 'update']);
        //fejvadasz
        Route::get('/hunter/headhunters/profile', [FejvadaszController::class, 'showsigned']);
        //allaskereso
        Route::get('/hunter/jobseekers/all', [AllaskeresoController::class, 'index']);
        Route::get('/hunter/jobseekers/{user_id}', [AllaskeresoController::class, 'show']);
        //munkaltato
        Route::get('/hunter/employers/all', [MunkaltatoController::class, 'index']);
        Route::get('/hunter/employers/{munkaltato_id}', [MunkaltatoController::class, 'show']);
        Route::post('/hunter/employers/new', [MunkaltatoController::class, 'store']);
        Route::put('/hunter/employers/modification/{munkaltato_id}', [MunkaltatoController::class, 'update']);
    });
    Route::middleware(['jobseeker'])->group(function () {
        //allas
        Route::get('/seeker/jobs/all', [AllasController::class, 'index']);
        Route::get('/seeker/jobs/{allas_id}', [AllasController::class, 'show']);
        //fejvadasz
        //allaskereso
        Route::get('/seeker/jobseekers/profile', [AllaskeresoController::class, 'showsigned']);


    });
});


//fejvadasz
Route::apiResource('/admin/headhunters', FejvadaszController::class);
//munkaltato

//terulet
Route::apiResource('/admin/fields', TeruletController::class);
//pozicio
Route::apiResource('/admin/positions', PozicioController::class);
//szakmai_ismeret
Route::apiResource('/admin/skills', SzakmaiIsmeretController::class);
//vegzettseg
Route::apiResource('/admin/edu-attainments', VegzettsegController::class);
//nyelvtudas
Route::apiResource('/admin/languages', NyelvtudasController::class);

