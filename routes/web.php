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
//probando 
//probando2

Route::get('/cargoejecutor', 'CargoejecutorController@index');
Route::post('/cargoejecutor/registrar', 'CargoejecutorController@store');
Route::put('/cargoejecutor/actualizar', 'CargoejecutorController@update');
Route::put('/cargoejecutor/desactivar', 'CargoejecutorController@desactivar');
Route::put('/cargoejecutor/activar', 'CargoejecutorController@activar');

Route::get('/cargoejecutor/selectCargoejecutor', 'CargoejecutorController@selectCargoejecutor');

Route::get('/ejecutor', 'EjecutorController@index');
Route::post('/ejecutor/registrar', 'EjecutorController@store');
Route::put('/ejecutor/actualizar', 'EjecutorController@update');
Route::put('/ejecutor/desactivar', 'EjecutorController@desactivar');
Route::put('/ejecutor/activar', 'EjecutorController@activar');
Route::get('/ejecutor/selectEjecutor', 'EjecutorController@selectEjecutor');

//Tipo Obra
Route::get('/tipoobra', 'TipoobraController@index');
Route::post('/tipoobra/registrar', 'TipoobraController@store');
Route::put('/tipoobra/actualizar', 'TipoobraController@update');
Route::put('/tipoobra/desactivar', 'TipoobraController@desactivar');
Route::put('/tipoobra/activar', 'TipoobraController@activar');

Route::get('/tipoobra/selectTipoobra', 'TipoobraController@selectTipoobra');


Route::get('/persona', 'PersonaController@index');
Route::post('/persona/registrar', 'PersonaController@store');
Route::put('/persona/actualizar', 'PersonaController@update');
Route::put('/persona/desactivar', 'PersonaController@desactivar');
Route::put('/persona/activar', 'PersonaController@activar');

Route::get('/persona/selectPersona', 'PersonaController@selectPersona');

//Estado Factibilidad
Route::get('/estadofactibilidad', 'EstadofactibilidadController@index');
Route::post('/estadofactibilidad/registrar', 'EstadofactibilidadController@store');
Route::put('/estadofactibilidad/actualizar', 'EstadofactibilidadController@update');
Route::put('/estadofactibilidad/desactivar', 'EstadofactibilidadController@desactivar');
Route::put('/estadofactibilidad/activar', 'EstadofactibilidadController@activar');
Route::get('/estadofactibilidad/selectEstadofactibilidad', 'EstadofactibilidadController@selectEstadofactibilidad');

//Solicitud factibilidad
Route::get('/solicitudfactibilidad', 'SolicitudfactibilidadController@index');
Route::post('/solicitudfactibilidad/registrar', 'SolicitudfactibilidadController@store');
Route::put('/solicitudfactibilidad/actualizar', 'SolicitudfactibilidadController@update');

