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


	Route::group(['middleware' => ['role:Ventas']], function () {
		/* Clientes*/
		Route::get('/clientes/all', 'ClienteController@getAllClientes');
		Route::get('/clientes/tipo/{tipo}', 'ClienteController@getByTipo');
		Route::resource('/clientes', 'ClienteController');
	
		/* Pedidos Clientes*/
		Route::put('/pedido_clientes/{id}/confirmar', 'PedidoClienteController@confirmarPedido')->name('pedido_clientes.confirmarPedido');
		Route::put('/pedido_clientes/{id}/facturar', 'PedidoClienteController@agregarFactura')->name('pedido_clientes.agregarFactura');
		Route::get('/pedido_clientes/{id}/pagos/excel', 'PedidoClienteController@exportPagosToExcel')->name('pedido_clientes.pagosToExcel');
		Route::get('/pedido_clientes/cliente/{id}', 'PedidoClienteController@getByRazonSocial');
		Route::get('/pedido_clientes/detalles/{id}', 'PedidoClienteController@getDetalles')->name('pedido_clientes.detalles');
		Route::get('/pedido_clientes/excel', 'PedidoClienteController@exportToExcel')->name('pedido_clientes.exportToExcel');
		Route::resource('/pedido_clientes', 'PedidoClienteController');
		/*Movimientos */
		
		Route::get('/movimientos/validar', 'MovimientoController@validarSinRegistrar')->name('movimientos.validar');
		Route::get('/movimientos_data_between/{fechaInicio?}/{fechaFin?}', 'MovimientoController@movimientosDataBetween')->name('movimientos.movimientosDataBetween');
		Route::get('/movimientos/excel', 'MovimientoController@exportToExcel')->name('movimientos.exportToExcel');
		Route::resource('/movimientos', 'MovimientoController');

			/* Pago Clientes*/
		Route::post('/pago_clientes/pedidos/{cliente}', 'PagoClienteController@pagoBloque')->name('pago_clientes.pagoBloque');
		Route::get('/pago_clientes/excel', 'PagoClienteController@exportToExcel')->name('pago_clientes.exportToExcel');
		Route::resource('/pago_clientes', 'PagoClienteController');
	});


	Route::middleware(['role:Administrador'])->group(function () {
		/* Trabajadores*/
		Route::resource('/trabajadores', 'TrabajadorController');
		Route::resource('/users', 'UserController');
	
		/* EMPRESA */
		Route::resource('/empresa','EmpresaController');
		Route::resource('/bancos','BancoController');
		Route::resource('/cuentas','CuentaController');
		Route::resource('/stock','StockController');
		Route::resource('/egreso_gerencia','EgresoGerenciaController');
		Route::get('/pagar_gastos_gerencia','EgresoGerenciaController@showGastosPago')
				->name('egreso_gerencia.showGastosPago');

	});
		Route::post('/pagar_gastos_gerencia_store',
				'EgresoGerenciaController@storePagoEgreso')
				->name('egreso_gerencia.storePagoEgreso');

	Route::middleware(['role:Grifos'])->group(function(){
		/* Grifo */
		Route::get('/grifos/all/{fecha?}', 'GrifoController@getGrifosSinIngreso')->name('grifos.sinIngreso');
		Route::resource('/grifos', 'GrifoController');
		Route::get('/balanceo_grifos','GrifoController@balanceo')->name('grifos.balanceo');
		Route::post('/balancear_grifos','GrifoController@balancear')->name('grifos.balancear');
		Route::get('/reporte_comparacion_grifos','GrifoController@reporteComparacion')->name('grifos.reporte_comparacion');
		Route::get('/reporte_comparacion_grifos_data/{fecha?}','GrifoController@reporteComparacionData');

		Route::resource('/series','SerieController');
		Route::post('/asignar_series','SerieController@asignar_series')->name('asignacion_series');
		Route::get('/eliminar_asignacion/{id}','SerieController@eliminar_asignacion')
			->name('eliminar_asignacion');

		/**	STOCK GRIFOS */
		Route::resource('/stock_grifos','StockGrifoController');
		Route::get('/stock_grifos/all/{fecha?}','StockGrifoController@getGrifosSinStockRegistrado');

		Route::get('/traslado_galones/reporte_clientes_grifos','TrasladoGalonesController@reporteGrifosClientesDiario')
			->name('traslado_galones.reporteGrifosClientesDiario');
		Route::get('/traslado_galones_reporte_diario/{fecha?}','TrasladoGalonesController@reporteGrifosClientesDiarioData');

		Route::get('/reporte_clientes_grifos/mensual','TrasladoGalonesController@reporteGrifosClientesMensual')->name('traslado_galones.reporteGrifosClientesMensual');
		Route::get('/reporte_clientes_grifos_mensual/{fecha?}','TrasladoGalonesController@reporteGrifosClientesMensualData');

		Route::resource('/traslado_galones','TrasladoGalonesController');
		Route::get('/grifos_all','GrifoController@getAllGrifos');

/**/	Route::get('/clientes_all','ClienteController@getAllClientesSelect');
			
				/* EGRESOSS -  GASTOS (GRIFOS)*/
		Route::resource('/categoria_gastos', 'CategoriaGastoController');
		Route::resource('/sub_categoria_gastos', 'SubCategoriaGastoController');
		Route::resource('/concepto_gastos', 'ConceptoGastoController');
		//GASTOS GRIFO REPORTE 
		Route::resource('/egresos', 'EgresoController');
		Route::get('reporte_gastos_anual','EgresoController@reporteEgresosGrifoAnual')
				->name('egresos.reporte_gastos_anual');
		Route::get('/reporte_egresos_grifos_diario_data/{fecha?}','EgresoController@reporteEgresosGrifoDiarioData');
		Route::get('/reporte_egresos_grifos_mensual_data/{fecha?}','EgresoController@reporteEgresosGrifoMensualData');
		Route::get('/reporte_egresos_grifos_anual_data/{fecha?}','EgresoController@reporteEgresosGrifoAnualData');
		Route::get('/chart-egresos-grifos-anual-ajax','EgresoController@reporteEgresosGrifoAnualAjax');
		Route::get('/reporte_egresos_x_grifo_anual_data/{fecha?}','EgresoController@reporteEgresosXGrifoAnualData');
		Route::get('/chart-egresos-x-grifo-anual-ajax','EgresoController@reporteEgresosXGrifoAnualAjax');

		//gastos grifo
		Route::get('/subcategorias','SubCategoriaGastoController@getSubCategorias');
		Route::get('/conceptos','ConceptoGastoController@getConceptos');
		Route::resource('gastos','GastosController');
		Route::get('egresos_listado','EgresoController@listado')->name('egresos.listado');

		/* Ingresos Grifos */
		Route::get('/ingreso_grifos/grifo/{id}', 'IngresoGrifoController@getLastIngreso')->name('pago_clientes.lastIngreso');
		Route::resource('/ingreso_grifos', 'IngresoGrifoController');
		Route::resource('/ingresos_otros', 'IngresoController');
		Route::resource('/categoria_ingresos', 'CategoriaIngresoController');
		Route::get('ingresos_fecha_data/{date?}','IngresoController@getIngresoByDay');

			/* INGRESOS NETOS  (GRIFOS)*/	
		Route::resource('ingreso_grifo_neto','IngresoNetoGrifoController');//grifos
		Route::get('/reporte_ingresos_grifos_diario_data/{fecha?}','IngresoNetoGrifoController@reporteIngresoGrifoNetoDiarioData');
		Route::get('/reporte_ingresos_grifos_mensual_data/{fecha?}','IngresoNetoGrifoController@reporteIngresoGrifoNetoMensualData');
		Route::get('/reporte_ingresos_grifos_anual','IngresoNetoGrifoController@reporteIngresoGrifoNetoAnual')->name('ingreso_grifo_neto.anual');
		Route::get('/reporte_ingresos_grifos_anual_data/{fecha?}','IngresoNetoGrifoController@reporteIngresoGrifoNetoAnualData');
		Route::get('/reporte_ingresos_x_grifo_anual_data/{fecha?}','IngresoNetoGrifoController@reporteIngresosNetoXGrifoAnualData');
		Route::get('/chart-ingresos-grifos-anual-ajax','IngresoNetoGrifoController@reporteIngresoGrifoNetoAnualAjax');
		Route::get('/chart-ingresos-x-grifo-anual-ajax','IngresoNetoGrifoController@reporteIngresosNetoXGrifoAnualAjax');
	//detallado
		Route::get('/reporte_ingresos_detallado_diario','IngresoNetoGrifoController@ingresoDetalladoGrifo')
			->name('ingreso_grifo_neto.detallado');
		Route::get('/reporte_ingresos_detallado_diario_data/{fecha?}','IngresoNetoGrifoController@ingresoDetalladoGrifoDataI');
		Route::get('/reporte_egresos_detallado_diario_data/{fecha?}','IngresoNetoGrifoController@ingresoDetalladoGrifoDataE');
	//
		Route::resource('ganancia_zona_neta','GananciaNetaZonaController');
		Route::resource('ganancia_zona_neta','GananciaNetaZonaController');

		/* Venta Facturada*/
		Route::resource('/cancelacion','CancelacionController');
		Route::get('/cancelaciones/modify','CancelacionController@modify')->name('cancelacion.modify');
		Route::resource('/factura_grifos','FacturacionGrifoController');
		Route::get('/cancelacion_search/{id}/{fecha}','CancelacionController@cancelacion_search')->name('cancelacion_search');
		Route::get('/grifos_facturacion/all/{fecha?}','FacturacionGrifoController@getGrifosSinFacturacion')->name('factura_grifos.sinFactura');
		Route::get('/series_grifo/{id?}/{fecha?}','FacturacionGrifoController@series_grifo')->name('factura_grifos.series_grifo');
		Route::resource('/movimiento_grifos','MovimientoGrifoController');
		Route::get('/movimientos_grifos_data_between/{fechaInicio?}/{fechaFin?}', 'MovimientoGrifoController@movimientosDataBetween');
		Route::get('/movimiento_grifos_verificar', 'MovimientoGrifoController@verificarSinRegistrar')->name('movimiento_grifos.verificar');


	});

	/** DEPOSITOS-.... */
	Route::resource('/depositos','DepositoController');
	Route::get('/modify','DepositoController@modify')->name('depositos.modify');
	Route::get('depositos_fecha_data/{date?}','DepositoController@getDepositosByDay');



	/*  EGRESOS OTROS... */
	Route::resource('/salidas','SalidaController');
	Route::resource('/categoria_egresos', 'CategoriaEgresoController');
	//Route::get('/egresos_dt/{date?}','SalidaController@egresosDT');
	Route::get('salidas_fecha_data/{date?}','SalidaController@getSalidasByDay');


	/* Transporte - Nelida*/
	Route::resource('/transporte','TransporteController');
	Route::resource('/ingreso_transporte','IngresoTransporteController');
	Route::resource('/egreso_transporte','EgresoTransporteController');
	Route::get('/placas_transporte/{id}','EgresoTransporteController@placas_transporte')->name('egreso_transporte.placas_transporte');
	Route::resource('/ingreso_neto_transporte','IngresoNetoTransporteController');
		

		/**----------REPORTESSSSSS-----------*/
	//GENERAL
	//INGRESOS
	Route::get('reporte_general_ingresos_diario'
		,'ReporteGeneralIngresosController@reporteIngresosDiario')
			->name('reporte_general.ingresos.diario');
	Route::get('reporte_general_ingresos_diario_data/{date?}',
		'ReporteGeneralIngresosController@reporteIngresosDiarioData');
	Route::get('reporte_general_ingresos_mensual'
		,'ReporteGeneralIngresosController@reporteIngresosMensual')
			->name('reporte_general.ingresos.mensual');
	Route::get('reporte_general_ingresos_mensual_data/{date?}',
		'ReporteGeneralIngresosController@reporteIngresosMensualData');
	Route::get('reporte_general_ingresos_anual'
		,'ReporteGeneralIngresosController@reporteIngresosAnual')
			->name('reporte_general.ingresos.anual');
	Route::get('reporte_general_ingresos_anual_data/{date?}',
		'ReporteGeneralIngresosController@reporteIngresosAnualData');
	Route::get('chart-ingreso-anual-ajax', 'ReporteGeneralIngresosController@reporteIngresosAnualAjax');
	//EGRESOS
	Route::get('reporte_general_egresos_diario'
		,'ReporteGeneralEgresosController@reporteEgresosDiario')
			->name('reporte_general.egresos.diario');
	Route::get('reporte_general_egresos_diario_data/{date?}',
		'ReporteGeneralEgresosController@reporteEgresosDiarioData');
	Route::get('reporte_general_egresos_mensual'
		,'ReporteGeneralEgresosController@reporteEgresosMensual')
			->name('reporte_general.egresos.mensual');
	Route::get('reporte_general_egresos_mensual_data/{date?}',
		'ReporteGeneralEgresosController@reporteEgresosMensualData');
	Route::get('reporte_general_egresos_anual'
		,'ReporteGeneralEgresosController@reporteEgresosAnual')
			->name('reporte_general.egresos.anual');
	Route::get('reporte_general_egresos_anual_data/{date?}',
		'ReporteGeneralEgresosController@reporteEgresosAnualData');
	Route::get('chart-egresos-anual-ajax', 'ReporteGeneralEgresosController@reporteEgresosAnualAjax');
	//DEPOSITOS
	Route::get('reporte_general_depositos_diario'
		,'ReporteGeneralDepositosController@reporteDepositosDiario')
			->name('reporte_general.depositos.diario');
	Route::get('reporte_general_depositos_diario_data/{date?}',
		'ReporteGeneralDepositosController@reporteDepositosDiarioData');


	//Reportes TRANSPORTES
		//UNIDADES
	Route::get('/reporte_diario_unidades','TransporteReporteController@reporteDiarioUnidades')
		->name('transporte.reporteDiarioUnidades');

	
	Route::get('/reporte_mensual_unidades','TransporteReporteController@reporteMensualUnidades')
		->name('transporte.reporteMensualUnidades');

	Route::get('/reporte_anual_unidades','TransporteReporteController@reporteAnualUnidades')
		->name('transporte.reporteAnualUnidades');

		//TODOS
	Route::get('/reporte_diario_transportes',
		'TransporteReporteController@reporteDiarioTotal')->name('transporte.reporteDiarioTotal');
	// Route::get('/reporte_diario_transportes_data',
	// 	'TransporteReporteController@reporteDiarioTotalData');	
	Route::get('/reporte_mensual_transportes',
		'TransporteReporteController@reporteMensualTotal')->name('transporte.reporteMensualTotal');
	// Route::get('/reporte_mensual_transportes_data',
	// 	'TransporteReporteController@reporteMensualTotalData');
	Route::get('/reporte_anual_transportes',
		'TransporteReporteController@reporteAnualTotal')->name('transporte.reporteAnualTotal');

	Route::get('/reporte_mensual_ingresos_transportes',
		'TransporteController@reporteMensual')
		->name('transporte.reporteMensualIngresos');
	Route::get('/reporte_mensual_egresos_transportes',
		'TransporteController@reporteMensual')
		->name('transporte.reporteMensualEgresos');

	Route::get('/reporte_anual_ingresos_transportes',
		'TransporteController@reporteAnualIngresos')->name('transporte.reporteAnualIngresos');
	Route::get('/reporte_anual_ingresos_transportes_data/{year?}',
		'TransporteController@reporteAnualIngresosData');	
	Route::get('/reporte_anual_egresos_transportes',
		'TransporteController@reporteAnualEgresos')->name('transporte.reporteAnualEgresos');
	Route::get('/reporte_anual_egresos_transportes_data/{year?}',
		'TransporteController@reporteAnualEgresosData');

		//reporte PEdidos COMbustible
	Route::get('reporte_pedidos_combustible/{day?}/{idPedido?}',
			'PedidoController@reportePedidosCombustible')
			->name('pedidos.reportePedidosCombustible');

	Route::get('reporte_pedidos_combustible_export/{day?}/{idPedido?}','PedidoController@exportView')
		->name('pedidos.export_view');
	// REPORTE PROGRAMACION
	Route::get('/pedidos_programacion', 'PedidoController@programacion')->name('pedidos.programacion');

	/** * TRANSPORTISTASSS */
		/* Transportista & vehiculo */
		Route::resource('transportista', 'TransportistaController');
		Route::resource('vehiculo', 'VehiculoController');
		Route::resource('flete','FleteController');
		Route::delete('/flete_grifo/{id}/{id_grifo}','FaltanteController@destroyGrifoFaltante')->name('flete.destroyGrifoFaltante');		
		Route::resource('faltante','FaltanteController');
		Route::resource('pago_transportistas','PagoTransportistaController');
		Route::get('pago_transportista_excel/{id}','PagoTransportistaController@exportView')
			->name('pago_transportistas.exportView');


	Route::group(['middleware' => ['role:Proveedores']], function () {
		/* Proveedor & planta */	
		Route::resource('/proveedores', 'ProveedorController');
		Route::get('/proveedores_reporte','ProveedorController@reporte')->name('proveedores.reporte');
		Route::resource('/planta', 'PlantaController');
	
		/* Pedido Proveedor  */					
		Route::resource('/pedidos', 'PedidoController');
		Route::resource('factura_proveedor', 'FacturaProveedorController');
		Route::get('/procesar/{id}', 'PedidoController@confirmarPedido')->name('pedidos.confirmarPedido');
	
		/* Pago Proveedor  */	
		Route::resource('/pago_proveedors', 'PagoProveedorController');
		Route::get('resumen_pago/{id}','PagoProveedorController@resumen_pago')
				->name('pago_proveedors.resumen_pago');
		Route::delete('/pago_proveedors_reverse/{id}','PagoProveedorController@reverse')
				->name('pago_proveedors.reverse');
						
		//Eliminar Distribucion 
		Route::delete('/pedido_distribucion_reverse/{id}','PedidoController@reverse')
				->name('pedidos.reverse');
		/* Distribucion Pedido a clientess */	
		Route::get('distribuir/{id}', 'PedidoController@distribuir')
				->name('pedidos.distribuir');//mostrar interfaz distribución
		Route::put('distribuir_pedido/{id}', 'PedidoController@distribuir_pedido')
				->name('pedidos.distribuir_pedido');//algoritmo distribucion en bloque a pedido clientes
		Route::get('ver_distribucion/{id}', 'PedidoController@ver_distribucion')
				->name('pedidos.ver_distribucion');//ver resumen distribucion
		Route::get('showVehiTrans/{id}','TransportistaController@showVehiTrans');
	
		/* Distribucion Pedido a grifos */
		Route::post('asignar_gls', 'PedidoController@asignar_grifo')
				->name('asignar_gls');//asignar gls de pedido a grifos(algoritmo)
		Route::post('asignar_individual', 'PedidoController@asignar_individual')
				->name('asignar_individual');//asignar gls de pedido a grifos(algoritmo)
		Route::get('distribuir_grifo/{id}', 'PedidoController@distribuir_grifo')
				->name('pedidos.distribuir_grifo');
				//mostrar interfaz distribucion a grifos

	});


});
