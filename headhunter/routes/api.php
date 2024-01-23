<?php

use App\Http\Controllers\AllaskeresoController;
use App\Http\Controllers\FejvadaszController;
use App\Http\Controllers\MunkaltatoController;
use App\Http\Controllers\SzakmaiIsmeretController;
use App\Http\Controllers\TapasztalatIdoController;
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

Route::get('allaskeresos', [AllaskeresoController::class, 'index']);
Route::get('allaskeresos/{id}', [AllaskeresoController::class, 'show']);
Route::put('allaskeresos/{id}', [AllaskeresoController::class, 'update']);
Route::post('allaskeresos', [AllaskeresoController::class, 'store']);
Route::delete('allaskeresos/{id}', [AllaskeresoController::class, 'destroy']);

Route::get('fejvadaszs', [FejvadaszController::class, 'index']);
Route::get('fejvadaszs/{id}', [FejvadaszController::class, 'show']);
Route::put('fejvadaszs/{id}', [FejvadaszController::class, 'update']);
Route::post('fejvadaszs', [FejvadaszController::class, 'store']);
Route::delete('fejvadaszs/{id}', [FejvadaszController::class, 'destroy']);

Route::get('munkaltatos', [MunkaltatoController::class, 'index']);
Route::get('munkaltatos/{id}', [MunkaltatoController::class, 'show']);
Route::put('munkaltatos/{id}', [MunkaltatoController::class, 'update']);
Route::post('munkaltatos', [MunkaltatoController::class, 'store']);
Route::delete('munkaltatos/{id}', [MunkaltatoController::class, 'destroy']);

Route::get('szakmai_ismerets', [SzakmaiIsmeretController::class, 'index']);
Route::get('szakmai_ismerets/{id}', [SzakmaiIsmeretController::class, 'show']);
Route::put('szakmai_ismerets/{id}', [SzakmaiIsmeretController::class, 'update']);
Route::post('szakmai_ismerets', [SzakmaiIsmeretController::class, 'store']);
Route::delete('szakmai_ismerets/{id}', [SzakmaiIsmeretController::class, 'destroy']);

Route::get('tapasztalat_idos', [TapasztalatIdoController::class, 'index']);
Route::get('tapasztalat_idos/{id}', [TapasztalatIdoController::class, 'show']);
Route::put('tapasztalat_idos/{id}', [TapasztalatIdoController::class, 'update']);
Route::post('tapasztalat_idos', [TapasztalatIdoController::class, 'store']);
Route::delete('tapasztalat_idos/{id}', [TapasztalatIdoController::class, 'destroy']);

Route::get('vegzettsegs', [VegzettsegController::class, 'index']);
Route::get('vegzettsegs/{id}', [VegzettsegController::class, 'show']);
Route::put('vegzettsegs/{id}', [VegzettsegController::class, 'update']);
Route::post('vegzettsegs', [VegzettsegController::class, 'store']);
Route::delete('vegzettsegs/{id}', [VegzettsegController::class, 'destroy']);