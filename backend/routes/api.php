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

Route::post('/registrar', 'RegistroController@register');
Route::get('/estados', 'EstadoController@listar');
Route::get('/cidades/listar_por_estado', 'CidadeController@listarCidadesPorEstado');

Route::get('/locais', 'LocalController@locais');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/avaliar/{local}', 'AvaliacaoController@avaliar');

    Route::post('/reservas/{local}', 'ReservaController@reservar');
});

