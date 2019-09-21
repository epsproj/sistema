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


Route::get('/', function () {
    return view('contenido/contenido');
});
//probando1
Route::get('/cargoejecutor', 'CargoejecutorController@index');
Route::post('/cargoejecutor/registrar', 'CargoejecutorController@store');
Route::put('/cargoejecutor/actualizar', 'CargoejecutorController@update');
Route::put('/cargoejecutor/desactivar', 'CargoejecutorController@desactivar');
Route::put('/cargoejecutor/activar', 'CargoejecutorController@activar');

//Tipo Obra
Route::get('/tipoobra', 'TipoobraController@index');
Route::post('/tipoobra/registrar', 'TipoobraController@store');
Route::put('/tipoobra/actualizar', 'TipoobraController@update');
Route::put('/tipoobra/desactivar', 'TipoobraController@desactivar');
Route::put('/tipoobra/activar', 'TipoobraController@activar');

Route::get('/tipodevia', 'TipodeviaController@index');
Route::post('/tipodevia/registrar', 'TipodeviaController@store');
Route::post('/tipodevia/actualizar', 'TipodeviaController@update');
Route::post('/tipodevia/desactivar', 'TipodeviaController@desactivar');
Route::post('/tipodevia/activar', 'TipodeviaController@activar');