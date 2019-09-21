<?php
//socio
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

//pruebasishesler




