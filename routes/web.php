<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();


Route::get('/', 'Auth\LoginController@showLoginForm');

Route::get('/home', 'HomeController@index');

/* Compras */
Route::get('/compra/index', 'CompraController@index');
Route::post('/compra/save', 'CompraController@save');


/* productos */
Route::get('/producto/index', 'ProductoController@index');
Route::get('/producto/data', 'ProductoController@data');
Route::post('/producto/create', 'ProductoController@create');
Route::get('/producto/show/{id}', 'ProductoController@show');
Route::post('/producto/update/{id}', 'ProductoController@update');
Route::get('/producto/destroy/{id}', 'ProductoController@destroy');

/* provedores */
Route::get('/provedor/index', 'ProvedorController@index');
Route::get('/provedor/data', 'ProvedorController@data');
Route::post('/provedor/create', 'ProvedorController@create');
Route::get('/provedor/show/{id}', 'ProvedorController@show');
Route::post('/provedor/update/{id}', 'ProvedorController@update');
Route::get('/provedor/destroy/{id}', 'ProvedorController@destroy');
