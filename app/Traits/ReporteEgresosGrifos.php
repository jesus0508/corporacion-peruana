<?php

namespace CorporacionPeru\Traits;

use CorporacionPeru\Egreso;
use CorporacionPeru\Grifo;
use DB;
use Carbon\Carbon;

trait ReporteEgresosGrifos{

	/**
	 * [Egreoss Diario Grifos Rporte ]
	 * @param  [date] $date Día de ingreso format(Y-m-d)
	 * @return [collection]       [ingresos Dia]
	 */
    public function egresosGrifosDiario($date) {
       $egresosGrifos = Egreso::with('grifo:id,razon_social')
                    ->with('conceptoGasto.subCategoriaGasto.categoriaGasto:id,categoria')
                    ->where('fecha_egreso',$date)
                    ->get();
        return $egresosGrifos;
    }

    /**
     * [Egresos Mensual Grifos data ]
     * @param  [date] [Fecha mes (m-Y)]
     * @return [collection]       [ingresos Dia]
     */
    public function egresosGrifosMensual($date){
        list($numero_mes, $year) = explode("-", $date);  
        
        $egresos_mes = Egreso::join('grifos','egresos.grifo_id','=','grifos.id')
                ->whereYear('egresos.fecha_egreso',$year)
                ->whereMonth('egresos.fecha_egreso',$numero_mes)                
                ->select( 
                    'egresos.fecha_egreso',
                    DB::raw('sum(monto_egreso) as monto_egreso'), 
                    'grifos.razon_social as grifo'
                )
                ->groupBy('fecha_egreso','grifo')
                ->get();
    
        return $egresos_mes;
    }

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



}    