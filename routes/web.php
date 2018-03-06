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


Auth::routes(); //Todos los formularios de para administrar Usuarios estan aqui (Registro, login, etc)
Route::get('/auth/facebook', 'SocialAuthController@facebook');
Route::get('/auth/facebook/callback', 'SocialAuthController@callback');
Route::post('/auth/facebook/register', 'SocialAuthController@register');

Route::group(['middleware' => 'auth'], function(){
	Route::post('/messages/create', 'MessagesController@create')//->middleware('auth');
	Route::post('/{username}/follow', 'UsersController@follow')//->middleware('auth');
	Route::post('/{username}/unfollow', 'UsersController@unfollow')//->middleware('auth');
	Route::post('/{username}/dms', 'UsersController@sendPrivateMessage');
})
Route::get('/{username}/follows', 'UsersController@follows');
Route::get('/{username}/followed', 'UsersController@followed');
Route::get('/{username}', 'UsersController@show');
