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









// rutas diego 
Route::get('/estadodenuncia', 'EstadodenunciaController@index');
Route::post('/estadodenuncia/registrar', 'EstadodenunciaController@store');
Route::post('/estadodenuncia/actualizar', 'EstadodenunciaController@update');
Route::post('/estadodenuncia/desactivar', 'EstadodenunciaController@desactivar');
Route::post('/estadodenuncia/activar', 'EstadodenunciaController@activar');
