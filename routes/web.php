<?php

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


Route::get('/', 'Sistema@index')->name('home');
Route::post('/informacion', 'Sistema@datos')->name('informacion');
Route::post('grafico_barras', 'Sistema@barras')->name('barras');
Route::post('grafico_tortas', 'Sistema@tortas')->name('tortas');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
