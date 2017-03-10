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
Route::post('/inicio/cambiarPassword', array('as' => '/inicio/cambiarPassword', 'uses' => 'HomeController@cambiarPassword'));
Route::get('/panel', 'PanelController@index');
Route::get('/inventario', 'InventarioHomeController@index');
Route::get('/reportes', 'AuditoriaHomeController@index');
Route::get('/403', 'ForbiddenViewController@index');
Route::get('/panel/agregarUsuario', 'AddUserController@index');
Route::get('/panel/administrarUsuarios', 'ManageUsers@index');
Route::post('/panel/agregarUsuario', array('as' => '/panel/agregarUsuario', 'uses' => 'AddUserController@agregarUsuario'));
Route::post('/panel/administrarUsuarios/cambiarPassword', array('as' => '/panel/administrarUsuarios/cambiarPassword', 'uses' => 'ManageUsers@cambiarPassword'));
Route::post('/panel/administrarUsuarios/borrarUsuario', array('as' => '/panel/administrarUsuarios/borrarUsuario', 'uses' => 'ManageUsers@borrarUsuario'));
Route::post('/panel/administrarUsuarios/getUserData', array('as' => '/panel/administrarUsuarios/getUserData', 'uses' => 'ManageUsers@getUserData'));
Route::post('/panel/administrarUsuarios/actualizarUsuario', array('as' => '/panel/administrarUsuarios/actualizarUsuario', 'uses' => 'ManageUsers@editarUsuario'));