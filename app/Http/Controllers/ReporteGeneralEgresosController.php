<?php

namespace CorporacionPeru\Http\Controllers;

use Illuminate\Http\Request;
use CorporacionPeru\Salida;
use Carbon\Carbon;
use CorporacionPeru\CategoriaEgreso;
use DB;
class ReporteGeneralEgresosController extends Controller
{

	/**
	 *  Muestra reporte general diario de Egresos
	 * @return [view] 
	 */
    public function reporteEgresosDiario()    
    {      
       
        $today_date = strftime( '%d/%m/%Y',strtotime('now') );
        return view('reporte_general.egresos.diario.index',compact('today_date'));
    }

    /**
     * Datos de Reporte general diario de egresos consultados.
     * @param  [date] $date [fecha de reporte]
     * @return [json]       [formato para datatables]
     */
    public function reporteEgresosDiarioData($date = null){

    	if ( $date == null ) {
	        $date = Carbon::now()->format('Y-m-d');
	    }
	    //Egresos registrados manualmente
        $egresos1 = Salida::join('categoria_egresos','categoria_egresos.id','=','salidas.categoria_egreso_id')
        	->leftJoin('cuentas','cuentas.id','=','salidas.cuenta_id')
        	->where('salidas.fecha_reporte',$date)
            ->select('salidas.*','categoria_egresos.categoria','cuentas.nro_cuenta')
            ->get();

	    //Egresos  Pago Proveedores
          $egresos2 = CategoriaEgreso::join('pago_proveedors','categoria_egresos.id','=','pago_proveedors.categoria_egreso_id')
          	->join('pago_pedido_proveedors',
          		'pago_pedido_proveedors.pago_proveedor_id','=','pago_proveedors.id')
          	->join('pedidos','pago_pedido_proveedors.pedido_id','=','pedidos.id')
          	->join('plantas','pedidos.planta_id','=','plantas.id')
          	->join('proveedores','proveedores.id','=','plantas.proveedor_id')
            ->select('pago_proveedors.codigo_operacion',
                'pago_proveedors.monto_operacion as monto_egreso',
                'pago_proveedors.fecha_operacion as fecha_egreso',
                'pago_proveedors.fecha_reporte',
                 DB::raw('CONCAT("Transferencia a",proveedores.razon_social) as detalle'),
                'proveedores.created_at as nro_cuenta',
                'proveedores.created_at as nro_cheque',
                'categoria_egresos.categoria')
            ->get(); 
        $collection = collect([$egresos1, $egresos2]);
        $collapsed = $collection->collapse();
        $egresos =$collapsed->all(); 
        return response()->json(['data' => $egresos]);
    }

	/**
	 *  Muestra reporte general diario de Egresos
	 * @return [view] 
	 */
    public function reporteEgresosMensual()    
    {      
       
        $today_date = strftime( '%d/%m/%Y',strtotime('now') );
        return view('reporte_general.egresos.diario.index',compact('today_date'));
    }

    /**
     * Datos de Reporte general mensual de egresos consultados.
     * @param  [date] $date [fecha de reporte]
     * @return [json]       [formato para datatables]
     */
    public function reporteEgresosMensualData($date = null){

    }
}
