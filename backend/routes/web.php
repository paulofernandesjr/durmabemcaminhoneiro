<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin'], function () {
    Auth::routes(['register' => false]);

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('locais', 'LocalController', [
        'except' => 'destroy',
        'parameters' => [
            'locais' => 'local'
        ],
    ]);
});
