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


Route::get('/', array('before' => 'auth', 'uses' => 'HomeController@index'));


Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('/');
});

Auth::routes();

Route::get('/inicio', 'HomeController@index');
Route::get('/panel', 'PanelController@index');
Route::get('/panel/agregarUsuario', 'AddUserController@index');
Route::get('/panel/administrarUsuarios', 'ManageUsers@index');
Route::get('/panel/editarUsuario', 'EditarUsuario@index');
Route::post('/panel/agregarUsuario', array('as' => '/panel/agregarUsuario', 'uses' => 'AddUserController@agregarUsuario'));

