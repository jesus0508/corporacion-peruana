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
	Route::get('/clientes/tipo/{tipo}','ClienteController@getByTipo');
	Route::resource('/proveedores','ProveedorController');
	Route::resource('/pedidos','PedidoController');
	Route::resource('/pedido_clientes','PedidoClienteController');
	Route::get('/procesar/{id}','PedidoClienteController@procesarPedido')->name('pedido_clientes.procesarPedido');
  Route::resource('/pago_clientes', 'PagoClienteController');
  Route::resource('/planta','PlantaController');
  Route::resource('factura_proveedor', 'FacturaProveedorController');
	Route::resource('transportista', 'TransportistaController');
	Route::resource('vehiculo', 'VehiculoController');    
  Route::get('proveedores_data', 'ProveedorController@datatable');
	Route::get('plantas_data/{id}', 'PlantaController@show');
	Route::get('planta_delete/{id}', 'PlantaController@destroy');
});
