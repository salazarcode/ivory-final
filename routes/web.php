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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//users
Route::get('/users/{id?}', 'UsersController@retrieve');
Route::post('/users', 'UsersController@create');
Route::post('/users/{id}', 'UsersController@update');
Route::get('/users/destroy/{id}', 'UsersController@delete');

//ServiciosTipos
Route::get('/servicios-tipos/{id?}', 'ServiciosTiposController@retrieve');
Route::post('/servicios-tipos', 'ServiciosTiposController@create');
Route::post('/servicios-tipos/{id}', 'ServiciosTiposController@update');
Route::get('/servicios-tipos/destroy/{id}', 'ServiciosTiposController@delete');

//CredencialesTipos
Route::get('/credenciales-tipos/{id?}', 'CredencialesTiposController@retrieve');
Route::post('/credenciales-tipos', 'CredencialesTiposController@create');
Route::post('/credenciales-tipos/{id}', 'CredencialesTiposController@update');
Route::get('/credenciales-tipos/destroy/{id}', 'CredencialesTiposController@delete');

//Credenciales
Route::post('/credenciales', 'CredencialesController@save');
Route::get('/credenciales/{servicio_id}/{credencialtipo_id}', 'CredencialesController@retrieve');

//Servicios
Route::post('/servicios', 'ServiciosController@create');
Route::get('/servicios/destroy/{servicio_id}', 'ServiciosController@delete');
Route::get('/servicios/{marca_id}/{serviciotipo_id?}', 'ServiciosController@retrieve');

//Marcas
Route::post('/marcas', 'MarcasController@create');
Route::get('/marcas/{id?}', 'MarcasController@retrieve');
Route::post('/marcas/{id}', 'MarcasController@update');
Route::get('/marcas/destroy/{id}', 'MarcasController@delete');

