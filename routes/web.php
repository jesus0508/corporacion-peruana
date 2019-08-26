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
Route::redirect('/', 'login', 301);

Route::middleware(['auth'])->group(function () {
	Route::get('/home', 'HomeController@index')->name('home');
	/* Clientes*/
	Route::get('/clientes/all', 'ClienteController@getAllClientes');
	Route::get('/clientes/tipo/{tipo}', 'ClienteController@getByTipo');
	Route::resource('/clientes', 'ClienteController');

	/* Pedidos Clientes*/
	Route::put('/pedido_clientes/{id}/confirmar', 'PedidoClienteController@confirmarPedido')->name('pedido_clientes.confirmarPedido');
	Route::get('/pedido_clientes/cliente/{id}', 'PedidoClienteController@getByRazonSocial');
	Route::get('/pedido_clientes/detalles/{id}', 'PedidoClienteController@getDetalles')->name('pedido_clientes.detalles');
	Route::resource('/pedido_clientes', 'PedidoClienteController');

	/* Trabajadores*/
	Route::resource('/trabajadores', 'TrabajadorController');
	Route::resource('/users', 'UserController');

	/* Pago Clientes*/
	Route::post('/pago_clientes/pedidos/{cliente}', 'PagoClienteController@pagoBloque')->name('pago_clientes.pagoBloque');
	Route::resource('/pago_clientes', 'PagoClienteController');

	/* Grifo */
	Route::get('/grifos/all/{fecha?}', 'GrifoController@getGrifosSinIngreso')->name('grifos.sinIngreso');
	Route::resource('/grifos', 'GrifoController');

	/* Ingreso */
	Route::get('/ingreso_grifos/grifo/{id}', 'IngresoGrifoController@getLastIngreso')->name('pago_clientes.lastIngreso');
	Route::resource('/ingreso_grifos', 'IngresoGrifoController');

	/* Proveedor & planta */	
	Route::resource('/proveedores', 'ProveedorController');
	Route::resource('/planta', 'PlantaController');

	/* Transportista & vehiculo */
	Route::resource('transportista', 'TransportistaController');
	Route::resource('vehiculo', 'VehiculoController');

	/* Pedido Proveedor  */					
	Route::resource('/pedidos', 'PedidoController');
	Route::resource('factura_proveedor', 'FacturaProveedorController');
	Route::get('/procesar/{id}', 'PedidoController@confirmarPedido')->name('pedidos.confirmarPedido');

	/* Pago Proveedor  */	
	Route::resource('/pago_proveedors', 'PagoProveedorController');

	/* Distribucion Pedido a clientess */	
	Route::get('distribuir/{id}', 'PedidoController@distribuir')
			->name('pedidos.distribuir');//mostrar interfaz distribución
	Route::put('distribuir_pedido/{id}', 'PedidoController@distribuir_pedido')
			->name('pedidos.distribuir_pedido');//algoritmo distribucion en bloque a pedido clientes
	Route::get('ver_distribucion/{id}', 'PedidoController@ver_distribucion')
			->name('pedidos.ver_distribucion');//ver resumen distribucion
	Route::get('showVehiTrans/{id}','TransportistaController@showVehiTrans');

	/* Distribucion Pedido a clientess */
	Route::post('asignar_gls', 'PedidoController@asignar_grifo')
			->name('asignar_gls');//asignar gls de pedido a grifos(algoritmo)
	Route::post('asignar_individual', 'PedidoController@asignar_individual')
			->name('asignar_individual');//asignar gls de pedido a grifos(algoritmo)
	Route::get('distribuir_grifo/{id}', 'PedidoController@distribuir_grifo')
			->name('pedidos.distribuir_grifo');//mostrar interfaz distribucion a grifos

	/* Gastos */
	Route::resource('gastos','GastosController');

});
