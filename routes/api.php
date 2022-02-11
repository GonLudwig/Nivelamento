<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'App\Http\Controllers\AuthController@login');

Route::prefix('v1')->middleware('jwt.auth')->group(function(){
    Route::post('me', 'App\Http\Controllers\AuthController@me');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::apiResource('nivel_ensino', 'App\Http\Controllers\NivelEnsinoController');
    Route::apiResource('nivelamento', 'App\Http\Controllers\NivelamentoController');
    Route::apiResource('prova', 'App\Http\Controllers\ProvaController');
    Route::apiResource('componente', 'App\Http\Controllers\ComponenteController');
    Route::apiResource('questao', 'App\Http\Controllers\QuestaoController');
    Route::apiResource('alternativa', 'App\Http\Controllers\AlternativaController');
    Route::apiResource('nivelamentos_provas', 'App\Http\Controllers\NivelamentosProvaController');
    Route::apiResource('provas_componentes', 'App\Http\Controllers\ProvasComponenteController');
});