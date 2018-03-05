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

Route::get('/', 'PagesController@home');
Route::get('/messages/{message}', 'MessagesController@show');
//Esta ruta es para el caso localhost/messages/1 :Donde 1 es un id cualquiera que se quiera consultar
//Cuendo entre a esa ruta, llamará el método show del Controlador MessagesController

Route::post('/messages/create', 'MessagesController@create')->middleware('auth');

Auth::routes(); //Todos los formularios de para administrar Usuarios estan aqui (Registro, login, etc)

Route::get('/{username}/follows', 'UsersController@follows');
Route::post('/{username}/follow', 'UsersController@follow')->middleware('auth');
Route::get('/{username}', 'UsersController@show');
