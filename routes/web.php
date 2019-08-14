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
	/* Clientes*/
	Route::get('/clientes/all','ClienteController@getAllClientes');
	Route::get('/clientes/tipo/{tipo}','ClienteController@getByTipo');
	Route::resource('/clientes','ClienteController');

	/* Pedidos Clientes*/
	Route::get('/pedido_clientes/cliente/{id}','PedidoClienteController@getByRazonSocial');
	Route::get('/pedido_clientes/detalles/{id}','PedidoClienteController@getDetalles')->name('pedido_clientes.detalles');
	Route::get('/procesar/{id}','PedidoClienteController@procesarPedido')->name('pedido_clientes.procesarPedido');
	Route::resource('/pedido_clientes','PedidoClienteController');

	/* Trabajadores*/
	Route::resource('/trabajadores','TrabajadorController');
	Route::resource('/users','UserController');
	
	/* Pago Clientes*/
	Route::post('/pago_clientes/pedidos/{cliente}','PagoClienteController@pagoBloque')->name('pago_clientes.pagoBloque');
	Route::resource('/pago_clientes', 'PagoClienteController');


	Route::resource('/proveedores','ProveedorController');
	Route::resource('/pedidos','PedidoController');
	Route::resource('/planta','PlantaController');
	Route::resource('factura_proveedor', 'FacturaProveedorController');
	Route::resource('transportista', 'TransportistaController');
	Route::resource('vehiculo', 'VehiculoController');
    Route::resource('/pago_proveedors', 'PagoProveedorController'); 
    Route::get('proveedores_data', 'ProveedorController@datatable');
    Route::get('distribuir/{id}', 'PedidoController@distribuir')->name('pedidos.distribuir');
	Route::put('distribuir_pedido/{id}', 'PedidoController@distribuir_pedido')->name('pedidos.distribuir_pedido');
	Route::get('ver_distribucion/{id}', 'PedidoController@ver_distribucion')->name('pedidos.ver_distribucion');
    Route::post('asignar_gls', 'PedidoController@asignar_individual')->name('asignar_gls');
    Route::get('/procesar/{id}','PedidoController@confirmarPedido')->name('pedidos.confirmarPedido');
});
