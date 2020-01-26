<?php

namespace CorporacionPeru\Traits;

use CorporacionPeru\Ingreso;
use CorporacionPeru\Categoria;
use CorporacionPeru\Egreso;
use CorporacionPeru\IngresoGrifo;
use CorporacionPeru\CategoriaIngreso;
use CorporacionPeru\MovimientoGrifo;
use CorporacionPeru\IngresoTransporte;
use Carbon\Carbon;
use DB;

trait ReporteGeneralIngresos{
	

    public function stringQueryMonthsReport(){
        return 
        "(SELECT 1 as IdMes , 'Enero'     as Mes UNION
            SELECT 2 as IdMes , 'Febrero'    as Mes UNION
            SELECT 3 as IdMes , 'Marzo'      as Mes UNION
            SELECT 4 as IdMes , 'Abril'      as Mes UNION
            SELECT 5 as IdMes , 'Mayo'       as Mes UNION
            SELECT 6 as IdMes , 'Junio'      as Mes UNION
            SELECT 7 as IdMes , 'Julio'      as Mes UNION
            SELECT 8 as IdMes , 'Agosto'     as Mes UNION
            SELECT 9 as IdMes , 'Septiembre' as Mes UNION
            SELECT 10 as IdMes, 'Octubre'    as Mes UNION
            SELECT 11 as IdMes, 'Noviembre'  as Mes UNION
            SELECT 12 as IdMes, 'Diciembre'  as Mes)";
    }
	/**
	 * [Ingresos Diario Rporte General description]
	 * @param  [date] $date Día de ingreso format(Y-m-d)
	 * @return [collection]       [ingresos Dia]
	 */
    public function ingresosDiario($date) {

        $ingresos1 = Ingreso::join('categoria_ingresos','categoria_ingresos.id','=','ingresos.categoria_ingreso_id')
        	->where('ingresos.fecha_ingreso',$date)
            ->select('ingresos.*','categoria_ingresos.categoria')
            ->get();
        //PAGOSS Depósitos Venta Directa a Clientes
        $ingresos2 = CategoriaIngreso::join('pago_clientes','categoria_ingresos.id','=','pago_clientes.categoria_ingreso_id')
            ->join('pago_cliente_pedido_cliente','pago_cliente_pedido_cliente.pago_cliente_id','=','pago_clientes.id')
            ->join('pedido_clientes','pedido_clientes.id','=','pago_cliente_pedido_cliente.pedido_cliente_id')            
            ->join('clientes','clientes.id','=','pedido_clientes.cliente_id')
            ->where('pago_clientes.fecha_reporte',$date)//fecha ingreso
            ->select('pago_clientes.codigo_operacion', 'clientes.razon_social as detalle' ,'pago_clientes.monto_operacion as monto_ingreso','pago_clientes.banco','pago_clientes.fecha_operacion as fecha_reporte',
                'categoria_ingresos.categoria',
                'pago_clientes.fecha_reporte as fecha_ingreso')
            ->groupBy('pago_clientes.codigo_operacion')
            ->get(); 
        //movimientos Depósitos Venta Directa a Clientes
        $ingresos3 = CategoriaIngreso::join('movimientos','categoria_ingresos.id','=','movimientos.categoria_ingreso_id')
            ->where('movimientos.estado','!=',3)
            ->where('movimientos.fecha_reporte',$date)
            ->select('movimientos.codigo_operacion','movimientos.monto_operacion as monto_ingreso','movimientos.banco',
                'movimientos.fecha_operacion as fecha_reporte',
                'movimientos.fecha_reporte as fecha_ingreso',
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
                'movimiento_grifos.fecha_operacion as fecha_reporte',
                'movimiento_grifos.fecha_reporte as fecha_ingreso',
                'banco','categoria_ingresos.categoria','categoria_ingresos.categoria as detalle')
            ->get();
          //  return $ingresos4;
            //Ingresos por transportes, Unidades
        $ingresos5 = IngresoTransporte::join('categoria_ingresos',
                    'categoria_ingresos.id','=','ingreso_transportes.categoria_ingreso_id')
            ->where('ingreso_transportes.fecha_reporte',$date)
            ->select('ingreso_transportes.id as ingresoBuses',
                    'ingreso_transportes.fecha_ingreso as day',
                    'ingreso_transportes.fecha_ingreso as fecha_reporte', 
                    'ingreso_transportes.fecha_reporte as fecha_ingreso',
                     DB::raw('sum(monto_ingreso) as monto_ingreso'),
                        'ingreso_transportes.deleted_at as codigo_operacion',
                        'ingreso_transportes.deleted_at as banco',
                         'categoria_ingresos.categoria' ,'categoria_ingresos.categoria as detalle'   )
            ->groupBy('day')
            ->get();  

          //PARA OBTENER LOS INGRESOS NETOS DE GRIFOS X ZONA
            //para mostrar en neto
        $egresos_zona_grifo = Egreso::join('grifos','grifos.id','=','egresos.grifo_id')
                    ->select(
                        DB::raw('DATE(fecha_reporte) as day'),
                        'fecha_egreso', 'fecha_reporte',
                        'grifos.zona',
                        DB::raw('-1*(sum(monto_egreso)) as monto'),'egresos.grifo_id'
                            )
                    ->where('egresos.fecha_egreso',$date)
                    ->groupBy('grifos.zona' ,'day')
                    ->get();

        $ingresos_zona_grifo = IngresoGrifo::join('grifos','grifos.id','=','ingreso_grifos.grifo_id')
                    ->join('categoria_ingresos','categoria_ingresos.id','=','ingreso_grifos.categoria_ingreso_id')
                    ->where('ingreso_grifos.fecha_ingreso',$date)
                    ->select('ingreso_grifos.fecha_reporte',
                            'fecha_ingreso',
                        'ingreso_grifos.fecha_reporte as day','grifos.zona',
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
                                    'fecha_ingreso'   => $ingreso->fecha_ingreso, 
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
        $collapsed  = $collection->collapse();
        $ingresos   = $collapsed->all(); 

        return $ingresos;
	}

    /**
     * [ingresosMensual description]
     * @param  [type] $date [Fecha mes (m-Y)]
     * @return [type] array [Ingresos de dias por mes elegido]
     */
    public function ingresosMensual($date){
        
        list($numero_mes, $year) = explode("-", $date);  

        $ingresosMes = Ingreso::whereMonth('fecha_ingreso',$numero_mes)
                            ->whereYear('fecha_ingreso',$year)
                            ->orderBy('fecha_ingreso')
                            ->get();
        $contador=1;
        $ingresos_mes = collect([]); 
        foreach ($ingresosMes as $ingresoMes) {
            $fecha_ingreso = $ingresoMes->fecha_ingreso;
            $fecha_ingreso = Carbon::createFromFormat('d/m/Y', $fecha_ingreso)->format('Y-m-d');
            $ingresos_fecha_ingreso = $this->ingresosDiario($fecha_ingreso);//trait
            $total_dia = 0;
            foreach ($ingresos_fecha_ingreso as $ingreso_fecha_ingreso) {            
                $total_dia += $ingreso_fecha_ingreso->monto_ingreso;
            }
            list($year, $numero_mes, $dia) = explode("-", $fecha_ingreso);
            $semana = config('constants.semana_name');
            $meses  = config('constants.meses_name');
            $dia = $semana[strftime('%w',strtotime($fecha_ingreso))].' '.strftime("%d",strtotime($fecha_ingreso) );
            $mes = $meses[($numero_mes) - 1];
            $ingreso_mes =[    
                    'nro'           => $contador,
                    'fecha_name'       => $dia.' de '.$mes.' del '.$year,    
                    'fecha_ingreso' => $ingresoMes->fecha_ingreso, 
                    'monto_ingreso' => $total_dia,
                    'mes'           => $mes
                    ];  
            $ingreso_mes = (object)$ingreso_mes; 
            $ingresos_mes->push($ingreso_mes);
            $contador++;
        }
    
        return $ingresos_mes;
    }
	/**
	 * [ingresosMensualOld Antigua forma de obtener ingresos mensuales por categoria
	 * ]
	 * @param  [type] $date [description]
	 * @return [type]       [description]
	 */
	public function ingresosMensualOld($date){


		list($numero_mes, $year) = explode("-", $date);
        //return $numero_mes;
         //Ingresos registrados manualmente
        $ingresos1 = Ingreso::join('categoria_ingresos','categoria_ingresos.id','=','ingresos.categoria_ingreso_id')
            ->whereMonth('ingresos.fecha_ingreso',$numero_mes)
            ->whereYear('ingresos.fecha_ingreso',$year)
            ->select(             
                DB::raw('CONCAT(MONTH(fecha_ingreso),"-",YEAR(fecha_ingreso)) as fecha_ingreso_MY'),
                'categoria_ingresos.categoria',
                DB::raw('CONCAT(MONTH(fecha_reporte),"-",YEAR(fecha_reporte)) as fecha_reporte_MY'),               
                DB::raw('sum(monto_ingreso) as monto'),
                'categoria_ingresos.updated_at as zona',  
                DB::raw('MONTH(fecha_reporte) as mes_ingreso'),
                DB::raw('YEAR(fecha_reporte) as year_ingreso') )
            ->groupBy('mes_ingreso','year_ingreso')//agrupo por fecha reporte
            ->get();
            //PAGOSS Depósitos Venta Directa a Clientes
        $ingresos2 = CategoriaIngreso::join('pago_clientes','categoria_ingresos.id','=','pago_clientes.categoria_ingreso_id')
            ->whereMonth('pago_clientes.fecha_reporte',$numero_mes)
            ->whereYear('pago_clientes.fecha_reporte',$year)        
            ->select(
                DB::raw('MONTH(fecha_operacion) as mes_ingreso'),
                DB::raw('YEAR(fecha_operacion) as year_ingreso'),
                DB::raw('CONCAT(MONTH(fecha_operacion),"-",YEAR(fecha_operacion)) as fecha_reporte_MY'),
                DB::raw('CONCAT(MONTH(fecha_reporte),"-",YEAR(fecha_reporte)) as fecha_ingreso_MY'),  
                DB::raw('sum(monto_operacion) as monto'),
                'categoria_ingresos.updated_at as zona',
                'categoria_ingresos.categoria')
            ->groupBy('mes_ingreso','year_ingreso')
            ->get();
          //movimientos Depósitos Venta Directa a Clientes
        $ingresos3 = CategoriaIngreso::join('movimientos','categoria_ingresos.id','=','movimientos.categoria_ingreso_id')
            ->where('movimientos.estado','!=',3)
            ->whereMonth('movimientos.fecha_reporte',$numero_mes)
            ->whereYear('movimientos.fecha_reporte',$year) 
            ->select(
                DB::raw('MONTH(fecha_operacion) as mes_ingreso'),
                DB::raw('YEAR(fecha_operacion) as year_ingreso'),
                DB::raw('CONCAT(MONTH(fecha_operacion),"-",YEAR(fecha_operacion)) as fecha_reporte_MY'),
                DB::raw('CONCAT(MONTH(fecha_reporte),"-",YEAR(fecha_reporte)) as fecha_ingreso_MY'),  
                DB::raw('sum(monto_operacion) as monto'),
                'categoria_ingresos.updated_at as zona',
                'categoria_ingresos.categoria')
            ->groupBy('mes_ingreso','year_ingreso')
            ->get(); 
            // Ingresos movimientos grifo -- ingreso extraordinario
        $ingresos4 = MovimientoGrifo::join('categoria_ingresos',
                    'categoria_ingresos.id','=','movimiento_grifos.categoria_ingreso_id')
            ->where('estado','!=',3)
            ->whereMonth('movimiento_grifos.fecha_reporte',$numero_mes)
            ->whereYear('movimiento_grifos.fecha_reporte',$year) 
            ->select(
                DB::raw('MONTH(fecha_operacion) as mes_ingreso'),
                DB::raw('YEAR(fecha_operacion) as year_ingreso'),
                DB::raw('CONCAT(MONTH(fecha_operacion),"-",YEAR(fecha_operacion)) as fecha_reporte_MY'),
                DB::raw('CONCAT(MONTH(fecha_reporte),"-",YEAR(fecha_reporte)) as fecha_ingreso_MY'),  
                DB::raw('sum(monto_operacion) as monto'),
                'categoria_ingresos.updated_at as zona',
                'categoria_ingresos.categoria')
            ->groupBy('mes_ingreso','year_ingreso')
            ->get();

            //Ingresos por transportes, Unidades
        $ingresos5 = IngresoTransporte::join('categoria_ingresos',
                    'categoria_ingresos.id','=','ingreso_transportes.categoria_ingreso_id')
            ->whereMonth('ingreso_transportes.fecha_ingreso',$numero_mes)
            ->whereYear('ingreso_transportes.fecha_ingreso',$year) 
            ->select(
                DB::raw('MONTH(fecha_reporte) as mes_ingreso'),
                DB::raw('YEAR(fecha_reporte) as year_ingreso'),
                DB::raw('CONCAT(MONTH(fecha_ingreso),"-",YEAR(fecha_ingreso)) as fecha_ingreso_MY'),
                DB::raw('CONCAT(MONTH(fecha_reporte),"-",YEAR(fecha_reporte)) as fecha_reporte_MY'),  
                DB::raw('sum(monto_ingreso) as monto'),
                'categoria_ingresos.updated_at as zona',
                'categoria_ingresos.categoria')
            ->groupBy('mes_ingreso','year_ingreso')
            ->get();  
          //PARA OBTENER LOS INGRESOS NETOS DE GRIFOS X ZONA
            //para mostrar en neto
        $egresos_zona_grifo = Egreso::join('grifos','grifos.id','=','egresos.grifo_id')
                    ->whereMonth('egresos.fecha_egreso',$numero_mes)
                    ->whereYear('egresos.fecha_egreso',$year) 
                    ->select(
                        DB::raw('MONTH(fecha_reporte) as mes_reporte'),
                        DB::raw('YEAR(fecha_reporte) as year_reporte'),
                        DB::raw('MONTH(fecha_egreso) as mes_egreso'),
                        DB::raw('YEAR(fecha_egreso) as year_egreso'),
                        DB::raw('-1*(sum(monto_egreso)) as monto'),
                        'grifos.zona')  
                    ->groupBy('grifos.zona' ,'mes_reporte','year_reporte')
                    ->get();

        $ingresos_zona_grifo = IngresoGrifo::join('grifos','grifos.id','=','ingreso_grifos.grifo_id')
                    ->join('categoria_ingresos','categoria_ingresos.id','=','ingreso_grifos.categoria_ingreso_id')
                    ->whereMonth('ingreso_grifos.fecha_ingreso',$numero_mes)
                    ->whereYear('ingreso_grifos.fecha_ingreso',$year) 
                    ->select(
                        DB::raw('MONTH(fecha_ingreso) as mes_ingreso'),
                        DB::raw('YEAR(fecha_ingreso) as year_ingreso'),
                        DB::raw('MONTH(fecha_reporte) as mes_reporte'),
                        DB::raw('YEAR(fecha_reporte) as year_reporte'),
                        DB::raw('sum(monto_ingreso) as monto'),
                        'grifos.zona',
                        'categoria_ingresos.categoria')
                    ->groupBy('zona','mes_reporte','year_reporte')
                    ->get();

        $ingreso_grifos_zonas = collect([]); 
        foreach ($ingresos_zona_grifo as $ingreso) {
            foreach ($egresos_zona_grifo as $egreso ) {
                if( $ingreso->mes_reporte == $egreso->mes_reporte 
                    AND $ingreso->year_reporte == $egreso->year_reporte 
                    AND $ingreso->zona==$egreso->zona){

                        $consolidado = $egreso->monto + $ingreso->monto;
                        $consolidado = round( $consolidado, 2 );
                        $neto =[     
                            'fecha_ingreso_MY'   => 
                            $ingreso->mes_ingreso.'-'.$ingreso->year_ingreso, 
                            'fecha_reporte_MY'   => 
                            $ingreso->mes_reporte.'-'.$ingreso->year_reporte,  
                            'zona' => $egreso->zona,
                            'categoria' => $ingreso->categoria,
                            'monto' => $consolidado ];    
                        $neto = (object)$neto;                  
                        $ingreso_grifos_zonas->push($neto);
                    }
                }                
            } 

        $collection = collect([$ingresos1, $ingresos2 , $ingresos3, $ingresos4,
         $ingresos5,    $ingreso_grifos_zonas]);
        $collapsed = $collection->collapse();
        $ingresos =$collapsed->all();

        return $ingresos;
	}


}