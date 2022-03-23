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
// Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('/home', 'HomeController@index');

/* welcome */
Route::get('/', 'WelcomeController@index');
Route::get('/inicio/data', 'WelcomeController@data');

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

/* cliente */
Route::get('/cliente/index', 'ClienteController@index');
Route::get('/cliente/data', 'ClienteController@data');
Route::post('/cliente/create', 'ClienteController@create');
Route::get('/cliente/show/{id}', 'ClienteController@show');
Route::post('/cliente/update/{id}', 'ClienteController@update');
Route::get('/cliente/destroy/{id}', 'ClienteController@destroy');


/* Compras */
Route::get('/compra/index', 'CompraController@index');
Route::post('/compra/search_provedor', 'CompraController@search_provedor');
Route::post('/compra/search_producto', 'CompraController@search_producto');
Route::post('/compra/save', 'CompraController@save');
Route::get('/compra/nota/lista', 'CompraController@index_nota');
Route::get('/compra/nota/data', 'CompraController@nota_data');
Route::get('/compra/nota/show/{id}', 'CompraController@nota_show')->name('compras.nota.show');

/* Venta */
Route::get('/venta/index', 'VentaController@index');
Route::post('/venta/search_producto', 'VentaController@search_producto');
Route::post('/venta/search_cliente', 'VentaController@search_cliente');
Route::post('/venta/save', 'VentaController@save');
Route::get('/venta/nota/lista', 'VentaController@index_nota');
Route::get('/venta/nota/data', 'VentaController@nota_data');
Route::get('/venta/nota/show/{id}', 'VentaController@nota_show')->name('venta.nota.show');

/* Almacen */
Route::get('/almacen/index', 'AlmacenController@index');
Route::get('/almacen/data', 'AlmacenController@data');
Route::get('/almacen/show/{id}', 'AlmacenController@show');
Route::post('/almacen/update', 'AlmacenController@update');
Route::post('/almacen/update_stock', 'AlmacenController@update_stock');


/* Usuarios */
Route::get('/user/index', 'UserController@index');
Route::get('/user/data', 'UserController@data');
Route::post('/user/create', 'UserController@create');
Route::get('/user/show/{id}', 'UserController@show');
Route::post('/user/update/{id}', 'UserController@update');
Route::post('/user/destroy/{id}', 'UserController@destroy');


/* Roles */
Route::get('/rol/index', 'RolController@index');
Route::get('/rol/data', 'RolController@data');
Route::get('/rol/show/{id}', 'RolController@show');
Route::post('/rol/create', 'RolController@create');
Route::post('/rol/update/{id}', 'RolController@update');
Route::post('/rol/destroy/{id}', 'RolController@destroy');

