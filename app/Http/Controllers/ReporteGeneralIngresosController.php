<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Ingreso;
use Illuminate\Http\Request;
use CorporacionPeru\Categoria;
use CorporacionPeru\Egreso;
use CorporacionPeru\IngresoGrifo;
use CorporacionPeru\CategoriaIngreso;
use CorporacionPeru\MovimientoGrifo;
use CorporacionPeru\IngresoTransporte;
use Carbon\Carbon;
use DB;

class ReporteGeneralIngresosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reporteIngresosDiario()    
    {      
       
        $today_date = strftime( '%d/%m/%Y',strtotime('now') );
        return view('reporte_general.ingresos.diario.index',compact('today_date'));
    }

    public function reporteIngresosDiarioData($date = null){

	    if ( $date == null ) {
	        $date = Carbon::now()->format('Y-m-d');
	     }             
	     //Ingresos registrados manualmente
        $ingresos1 = Ingreso::join('categoria_ingresos','categoria_ingresos.id','=','ingresos.categoria_ingreso_id')
        	->where('ingresos.fecha_reporte',$date)
            ->select('ingresos.*','categoria_ingresos.categoria','ingresos.created_at as esIngreso')
            ->get();
            //PAGOSS Depósitos Venta Directa a Clientes
        $ingresos2 = CategoriaIngreso::join('pago_clientes','categoria_ingresos.id','=','pago_clientes.categoria_ingreso_id')
            ->join('pago_cliente_pedido_cliente','pago_cliente_pedido_cliente.pago_cliente_id','=','pago_clientes.id')
            ->join('pedido_clientes','pedido_clientes.id','=','pago_cliente_pedido_cliente.pedido_cliente_id')            
            ->join('clientes','clientes.id','=','pedido_clientes.cliente_id')
            ->where('pago_clientes.fecha_reporte',$date)
            ->select('pago_clientes.codigo_operacion', 'clientes.razon_social as detalle' ,'pago_clientes.monto_operacion as monto_ingreso','pago_clientes.banco','pago_clientes.fecha_operacion as fecha_ingreso',
                'categoria_ingresos.categoria',
                'pago_clientes.fecha_reporte')
            ->groupBy('pago_clientes.codigo_operacion')
            ->get(); 
          //movimientos Depósitos Venta Directa a Clientes
        $ingresos3 = CategoriaIngreso::join('movimientos','categoria_ingresos.id','=','movimientos.categoria_ingreso_id')
            ->where('movimientos.estado','!=',3)
            ->where('movimientos.fecha_reporte',$date)
            ->select('movimientos.codigo_operacion','movimientos.monto_operacion as monto_ingreso','movimientos.banco','movimientos.fecha_operacion as fecha_ingreso',
                'movimientos.fecha_reporte',
                'categoria_ingresos.categoria','categoria_ingresos.id as id_cat',
                'categoria_ingresos.categoria as detalle'
            )
            ->get(); 
            // Ingresos movimientos grifo -- ingreso extraordinario
        $ingresos4 = MovimientoGrifo::join('categoria_ingresos',
                    'categoria_ingresos.id','=','movimiento_grifos.categoria_ingreso_id')
            ->where('estado','!=',3)
            ->where('movimiento_grifos.fecha_reporte',$date)
            ->select('movimiento_grifos.codigo_operacion',
                'movimiento_grifos.monto_operacion as monto_ingreso',
                'movimiento_grifos.fecha_operacion as fecha_ingreso',
                'movimiento_grifos.fecha_reporte',
                'banco','categoria_ingresos.categoria','categoria_ingresos.categoria as detalle')
            ->get();
          //  return $ingresos4;
            //Ingresos por transportes, Unidades
        $ingresos5 = IngresoTransporte::join('categoria_ingresos',
                    'categoria_ingresos.id','=','ingreso_transportes.categoria_ingreso_id')
            ->where('ingreso_transportes.fecha_reporte',$date)
            ->select('ingreso_transportes.id as ingresoBuses','ingreso_transportes.fecha_ingreso',
                     'ingreso_transportes.fecha_ingreso as day', 'ingreso_transportes.fecha_reporte',
                     DB::raw('sum(monto_ingreso) as monto_ingreso'),
                        'ingreso_transportes.deleted_at as codigo_operacion',
                        'ingreso_transportes.deleted_at as banco',
                         'categoria_ingresos.categoria' ,'categoria_ingresos.categoria as detalle'   )
            ->groupBy('day')
            ->get();  

          //PARA OBTENER LOS INGRESOS NETOS DE GRIFOS X ZONA
            //para mostrar en neto
        $egresos_zona_grifo = Egreso::join('grifos','grifos.id','=','egresos.grifo_id')
                    ->select(DB::raw('DATE(fecha_egreso) as day'), 'fecha_reporte',
                     'grifos.zona',
                        DB::raw('-1*(sum(monto_egreso)) as monto'),'egresos.grifo_id'
                            )//estado 0
                    ->where('egresos.fecha_reporte',$date)
                    ->groupBy('grifos.zona' ,'day')
                    ->get();

        $ingresos_zona_grifo = IngresoGrifo::join('grifos','grifos.id','=','ingreso_grifos.grifo_id')
                    ->join('categoria_ingresos','categoria_ingresos.id','=','ingreso_grifos.categoria_ingreso_id')
                    ->where('ingreso_grifos.fecha_reporte',$date)
                    ->select('ingreso_grifos.fecha_reporte',
                        'ingreso_grifos.fecha_ingreso as day','grifos.zona',
                     DB::raw('sum(monto_ingreso) as monto') , 'categoria_ingresos.categoria' ,'ingreso_grifos.grifo_id')
                    ->groupBy('day','grifos.zona')
                    ->get();

        $ingreso_grifos_zonas = collect([]); 
        foreach ($ingresos_zona_grifo as $ingreso) {
            foreach ($egresos_zona_grifo as $egreso ) {
                if( $ingreso->day == $egreso->day AND $ingreso->zona==$egreso->zona){
                        $consolidado = $egreso->monto + $ingreso->monto;
                        $consolidado = round( $consolidado, 2 );
                        $neto =[    'fecha_reporte'   => $ingreso->fecha_reporte, 
                                    'fecha_ingreso'   => $ingreso->day, 
                                    //'zona' => $egreso->zona,
                                    'categoria' => $ingreso->categoria,
                                    'detalle' => $ingreso->categoria,
                                    'banco' => '',
                                    'codigo_operacion'=> $egreso->zona,
                                    'monto_ingreso' => $consolidado ];    
                        $neto = (object)$neto;                  
                        $ingreso_grifos_zonas->push($neto);
                    }
                }                
            } 





        $collection = collect([$ingresos1, $ingresos2 , $ingresos3, $ingresos4,
         $ingresos5,   	$ingreso_grifos_zonas]);
        $collapsed = $collection->collapse();
        $ingresos =$collapsed->all(); 

        return response()->json(['data' => $ingresos]);
    }
}