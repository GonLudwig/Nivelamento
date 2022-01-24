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

Route::apiResource('alternativa', 'App\Http\Controllers\AlternativaController');

Route::apiResource('nivelamento', 'App\Http\Controllers\NivelamentoController');

Route::apiResource('prova', 'App\Http\Controllers\ProvaController');

Route::apiResource('questao', 'App\Http\Controllers\QuestaoController');

Route::apiResource('grupo_prova', 'App\Http\Controllers\GrupoProvaController');

Route::apiResource('grupo_questao', 'App\Http\Controllers\GrupoQuestaoController');

Route::apiResource('grupo_alternativa', 'App\Http\Controllers\GrupoAlternativaController');