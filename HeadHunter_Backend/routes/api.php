<?php

use App\Http\Controllers\AllasController;
use App\Http\Controllers\AllaskeresoController;
use App\Http\Controllers\FejvadaszController;
use App\Http\Controllers\MunkaltatoController;
use App\Http\Controllers\NyelvtudasController;
use App\Http\Controllers\PozicioController;
use App\Http\Controllers\SzakmaiIsmeretController;
use App\Http\Controllers\TeruletController;
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

//all
    //allas
    Route::get('/jobs/all', [AllasController::class, 'index']);
    Route::get('/jobs/{allas_id}', [AllasController::class, 'show']);

//csak admin
    //allas
    Route::delete('/admin/jobs/delete/{allas_id}', [AllasController::class, 'destroy']);
    //allaskereso
    Route::post('/admin/jobseekers/new', [AllaskeresoController::class, 'store']);
    Route::put('/admin/jobseekers/modification/{user_id}', [AllaskeresoController::class, 'update']);
    Route::delete('/admin/jobseekers/delete/{user_id}', [AllaskeresoController::class, 'destroy']);
    //fejvadasz
    Route::apiResource('/admin/headhunters', FejvadaszController::class);
    //munkaltato
    Route::delete('/admin/employers/delete/{munkaltato_id}', [MunkaltatoController::class, 'destroy']);
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

//fejvadász és admin
    //allas
    Route::post('/jobs/new', [AllasController::class, 'store']);
    Route::put('/jobs/modification/{allas_id}', [AllasController::class, 'update']);
    //allaskereso
    Route::get('/jobseekers/all', [AllaskeresoController::class, 'index']);
    Route::get('/jobseekers/{user_id}', [AllaskeresoController::class, 'show']);
    //munkaltato
    Route::get('/employers/all', [MunkaltatoController::class, 'index']);
    Route::get('/employers/{munkaltato_id}', [MunkaltatoController::class, 'show']);
    Route::post('/employers/new', [MunkaltatoController::class, 'store']);
    Route::put('/employers/modification/{munkaltato_id}', [MunkaltatoController::class, 'update']);
    //terulet

//admin és álláskereső


//auth: hogy adom meg, hogy a user csak a saját magához kapcsolódó adatokat érje el?
