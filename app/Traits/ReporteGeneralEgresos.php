<?php

namespace CorporacionPeru\Traits;

use CorporacionPeru\Salida;
use Carbon\Carbon;
use CorporacionPeru\CategoriaEgreso;
use DB;

trait ReporteGeneralEgresos{

		/**
	 * [Ingresos Diario Rporte General description]
	 * @param  [date] $date Día de ingreso format(Y-m-d)
	 * @return [collection]       [ingresos Dia]
	 */
    public function egresosDiario($date) {
		//Egresos registrados manualmente
        $egresos1 = Salida::join('categoria_egresos','categoria_egresos.id','=','salidas.categoria_egreso_id')
        	->leftJoin('cuentas','cuentas.id','=','salidas.cuenta_id')
        	->where('salidas.fecha_egreso',$date)
          ->select('salidas.*','categoria_egresos.categoria','cuentas.nro_cuenta')
          ->get();

	    //Egresos  Pago Proveedores
          $egresos2 = CategoriaEgreso::join('pago_proveedors','categoria_egresos.id','=','pago_proveedors.categoria_egreso_id')
          	->join('pago_pedido_proveedors',
          		'pago_pedido_proveedors.pago_proveedor_id','=','pago_proveedors.id')
          	->join('pedidos','pago_pedido_proveedors.pedido_id','=','pedidos.id')
          	->join('plantas','pedidos.planta_id','=','plantas.id')
          	->join('proveedores','proveedores.id','=','plantas.proveedor_id')
            ->where('pago_proveedors.fecha_reporte',$date)
            ->select('pago_proveedors.codigo_operacion',
                'pago_proveedors.monto_operacion as monto_egreso',
                'pago_proveedors.fecha_operacion as fecha_reporte',
                'pago_proveedors.fecha_operacion as day',
                'pago_proveedors.fecha_reporte as fecha_egreso',
                 DB::raw('CONCAT("Transferencia a",proveedores.razon_social) as detalle'),
                'proveedores.created_at as nro_cuenta',
                'proveedores.created_at as nro_cheque',
                'proveedores.created_at as nro_comprobante',                
                'categoria_egresos.categoria')
            //->groupBy('day')
            ->get(); 

        $collection = collect([$egresos1, $egresos2]);
        $collapsed = $collection->collapse();
        $egresos =$collapsed->all(); 
        return $egresos;
    }

    /**
     * [egresosMensual description]
     *
     * 
     * @param  [type] $date [Fecha mes (m-Y)]
     * @return [type] array [Ingresos de dias por mes elegido]
     */
    public function egresosMensual($date){
        
        list($numero_mes, $year) = explode("-", $date);  

        $nro_dias_mes = cal_days_in_month(CAL_GREGORIAN, $numero_mes,  $year);
        $egresos_mes = collect([]); 
        $contador=1;
        while ( $contador <= $nro_dias_mes ) {
 			      $fecha_egreso_dmy = $contador.'/'.$numero_mes.'/'.$year;
            $fecha_egreso = Carbon::createFromFormat('d/m/Y', $fecha_egreso_dmy)->format('Y-m-d');
            $egresos_fecha_egreso = $this->egresosDiario($fecha_egreso);//trait
            $total_dia = 0;
            foreach ($egresos_fecha_egreso as $egreso_fecha_egreso) {            
                $total_dia += $egreso_fecha_egreso->monto_egreso;
            }
            list($year, $numero_mes, $dia) = explode("-", $fecha_egreso);
            $semana = config('constants.semana_name');
            $meses  = config('constants.meses_name');
            $dia = $semana[strftime('%w',strtotime($fecha_egreso))].' '.strftime("%d",strtotime($fecha_egreso) );
            $mes = $meses[($numero_mes) - 1];
            $egreso_mes =[    
    					'nro'          => $contador,
    					'fecha_name'   => $dia.' de '.$mes.' del '.$year,    
    					'fecha_egreso' => $fecha_egreso_dmy, 
    					'monto_egreso' => $total_dia,
    					'mes'          => $mes
                    ];  
            $egreso_mes = (object)$egreso_mes; 
            $egresos_mes->push($egreso_mes);
            $contador++;
        }
    
        return $egresos_mes;
    }	

}