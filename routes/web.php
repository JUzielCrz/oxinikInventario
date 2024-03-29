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
Route::get('/product/history/{id}', 'ProductoController@history')->name('product.history');

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
Route::get('/compra/nota/edit/{id}', 'CompraController@edit')->name('compras.nota.edit');
Route::post('/compra/nota/update/product_add/{nota_id}', 'CompraController@product_add')->name('compras.nota.update.product_add');
Route::post('/compra/nota/update/encabezado/{nota_id}', 'CompraController@update_encabezado')->name('compras.nota.update_encabezado');
Route::get('/compra/nota/product/delete/{id}', 'CompraController@nota_product_delete')->name('compras.nota.product.delete');
Route::delete('/compra/nota/destroy/{id}', 'CompraController@destroy')->name('compras.nota.destroy');

/* Venta */
Route::get('/venta/index', 'VentaController@index');
Route::post('/venta/search_producto', 'VentaController@search_producto');
Route::post('/venta/search_cliente', 'VentaController@search_cliente');
Route::post('/venta/save', 'VentaController@save');
Route::get('/venta/nota/lista', 'VentaController@index_nota');
Route::get('/venta/nota/data', 'VentaController@nota_data');
Route::get('/venta/nota/show/{id}', 'VentaController@nota_show')->name('venta.nota.show');
Route::delete('/venta/nota/destroy/{id}', 'VentaController@destroy')->name('venta.nota.destroy');


/* Almacen */
Route::get('/almacen/general/index', 'AlmacenGeneralController@index');
Route::get('/almacen/general/data', 'AlmacenGeneralController@data');

Route::get('/almacen/fiscal/index', 'AlmacenFiscalController@index');
Route::get('/almacen/fiscal/data', 'AlmacenFiscalController@data');
Route::get('/almacen/fiscal/show/{id}', 'AlmacenFiscalController@show');
Route::post('/almacen/fiscal/update', 'AlmacenFiscalController@update');
Route::post('/almacen/fiscal/update_stock', 'AlmacenFiscalController@update_stock');

Route::get('/almacen/nofiscal/index', 'AlmacenNoFiscalController@index');
Route::get('/almacen/nofiscal/data', 'AlmacenNoFiscalController@data');
Route::get('/almacen/nofiscal/show/{id}', 'AlmacenNoFiscalController@show');
Route::post('/almacen/nofiscal/update', 'AlmacenNoFiscalController@update');
Route::post('/almacen/nofiscal/update_stock', 'AlmacenNoFiscalController@update_stock');


/* Config */
Route::get('/configuracion/index', 'ConfigController@index')->name('configuracion.index');
Route::post('/configuracion/save', 'ConfigController@save')->name('configuracion.save');
Route::get('/configuracion/getconfig', 'ConfigController@getconfig')->name('configuracion.getconfig');


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

