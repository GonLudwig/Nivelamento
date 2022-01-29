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

Route::apiResource('nivel_ensino', 'App\Http\Controllers\NivelEnsinoController');

Route::apiResource('nivelamento', 'App\Http\Controllers\NivelamentoController');

Route::apiResource('prova', 'App\Http\Controllers\ProvaController');

Route::apiResource('componente', 'App\Http\Controllers\ComponenteController');

Route::apiResource('questao', 'App\Http\Controllers\QuestaoController');

Route::apiResource('nivelamentos_provas', 'App\Http\Controllers\NivelamentosProvaController');

Route::apiResource('provas_componentes', 'App\Http\Controllers\ProvasComponenteController');