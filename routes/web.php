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
Auth::routes(['register' => false]);

Route::view('/', 'welcome');
Route::middleware(['auth'])->group(function(){
	Route::get('/home', 'HomeController@index')->name('home');
	Route::resource('/clientes','ClienteController');
	Route::resource('/proveedores','ProveedorController');
	Route::resource('/pedidos','PedidoController');
	Route::resource('/pedido_clientes','PedidoClienteController');
	Route::put('/pedido_clientes','PedidoClienteController@procesarPedido')->name('pedido_clientes.procesarPedido');
});
