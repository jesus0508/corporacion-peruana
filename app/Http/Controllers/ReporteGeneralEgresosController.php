<?php

namespace CorporacionPeru\Http\Controllers;

use Illuminate\Http\Request;
use CorporacionPeru\Salida;
use Carbon\Carbon;
use CorporacionPeru\CategoriaEgreso;
use DB;
use CorporacionPeru\Traits\ReporteGeneralEgresos;
use CorporacionPeru\Charts\PruebaChart;

class ReporteGeneralEgresosController extends Controller
{

  use ReporteGeneralEgresos;
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
	     $egresos = $this->egresosDiario($date);//trait

      return response()->json(['data' => $egresos]);
    }

	/**
	 *  Muestra reporte general diario de Egresos
	 * @return [view] 
	 */
    public function reporteEgresosMensual()    
    {      
       
        $this_year            = strftime( '%Y',strtotime('now') );          
        $meses                = config('constants.meses_name');
        $this_month           = strftime( '%m',strtotime('now') );
        $month_actual         = $meses[$this_month-1];
        $month_actual_date    = $month_actual.' '.$this_year;      
        $last_month_my        = strftime( '%m',strtotime('first day of -1 month') );
        $last_month           = $meses[$last_month_my-1];
        $last_month_date_my   = $last_month_my.'-'.$this_year;
        $last_month_date      = $last_month.' '.$this_year;
        $month_actual_date_my = $this_month.'-'.$this_year;

        return view('reporte_general.egresos.mensual.index',
          compact('month_actual','last_month',
            'month_actual_date','last_month_date','month_actual_date_my','last_month_date_my'));
    }

    /**
     * Datos de Reporte general mensual de egresos consultados.
     * @param  [date] $date [fecha de reporte]
     * @return [json]       [formato para datatables]
     */
    public function reporteEgresosMensualData($date=null)    
    {      
       
        if ( $date == null ) {
            $date = Carbon::now()->format('m-Y');
        }       

        $egresos = $this->egresosMensual($date);//trait
        return response()->json(['data' => $egresos]);
    }

    /**
     *  Muestra reporte general anual de Egresos
     *
     * @return \Illuminate\Http\Response
     */
    public function reporteEgresosAnual()    
    {      
        $year = strftime('%Y',strtotime('now'));       
        $last_year = strftime('%Y',strtotime('first day of -1 year'));
        $meses  = config('constants.meses_name');
        $api = url('/chart-egresos-anual-ajax');
        $chart = new PruebaChart;
        $chart->title('Egresos por año');
        $chart->labels($meses)->load($api);
          
        return view('reporte_general.egresos.anual.index',compact('year','last_year','chart'));
    }


    /**
     *  Datos para chart Egresos Anual
     *
     * @return \Illuminate\Http\Response
     */
    public function reporteEgresosAnualAjax(Request $request)    
    {      
        $year = $request->has('year') ? $request->year : date('Y');
        $meses  = config('constants.meses_name');
        $meses_values = [1,2,3,4,5,6,7,8,9,10,11,12];
        $egresos_year = collect([]); 
        foreach ($meses_values as $mes) {
            $fecha_egreso = $mes.'-'.$year;
            $egresos_fecha_egreso = $this->egresosMensual($fecha_egreso);//trait
            $total_mes = 0;
            $mes_name = $meses[$mes-1];
            foreach ($egresos_fecha_egreso as $egreso_fecha_egreso) {            
                $total_mes += $egreso_fecha_egreso->monto_egreso;
            }
            $egreso_year = $total_mes;
            $egresos_year->push($egreso_year);
        }
        $chart = new PruebaChart; 
        $chart->dataset('Egresos Anual - '.$year, 'bar', $egresos_year )->color('#f06292');

        return $chart->api();
    }

      /**
     * Datos de Reporte general anual de egresos .
     * @param  [string] $date [fecha de reporte, solo mes y año]
     * @return [json]       [formato para datatables]
     */
    public function reporteEgresosAnualData($year=null)    
    {      
       
        $year = ($year==null) ? date('Y'): $year;  

        $meses  = config('constants.meses_name');
        $meses_values = [1,2,3,4,5,6,7,8,9,10,11,12];
        $egresos_year = collect([]); 
        foreach ($meses_values as $mes) {
            $fecha_egreso = $mes.'-'.$year;
            $egresos_fecha_egreso = $this->egresosMensual($fecha_egreso);//trait
            $total_mes = 0;
            $mes_name = $meses[$mes-1];
            foreach ($egresos_fecha_egreso as $egreso_fecha_egreso) {            
                $total_mes += $egreso_fecha_egreso->monto_egreso;
            }
            $egreso_year =[   
                    'mes'           => $mes,
                    'mes_year'      => $mes_name.' del '.$year,
                    'monto_egreso' => $total_mes
                    ];  
            $egreso_year = (object)$egreso_year; 
            $egresos_year->push($egreso_year);
        }
        return response()->json(['data' => $egresos_year]);
    }
}

