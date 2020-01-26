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
use CorporacionPeru\Traits\ReporteGeneralIngresos;
use CorporacionPeru\Charts\PruebaChart;

class ReporteGeneralIngresosController extends Controller
{
    use ReporteGeneralIngresos;
    /**
     * Muestra reporte general diario de Ingresos
     *
     * @return \Illuminate\Http\Response
     */
    public function reporteIngresosDiario()    
    {      
        $today_date = strftime( '%d/%m/%Y',strtotime('now') );
        return view('reporte_general.ingresos.diario.index',compact('today_date'));
    }
    /**
     * Datos de Reporte general diario de ingresos consultados.
     * @param  [date] $date [fecha de reporte]
     * @return [json]       [formato para datatables]
     */
    public function reporteIngresosDiarioData($date = null){

	    if ( $date == null ) {
	        $date = Carbon::now()->format('Y-m-d');
	    }             
	   $ingresos = $this->ingresosDiario($date);//trait

        return response()->json(['data' => $ingresos]);
    }

    /**
     *  Muestra reporte general mensual de Ingresos
     *
     * @return \Illuminate\Http\Response
     */
    public function reporteIngresosMensual()    
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

        return view('reporte_general.ingresos.mensual.index',compact('month_actual','last_month',
            'month_actual_date','last_month_date','month_actual_date_my','last_month_date_my'));
    }

    /**
     * Datos de Reporte general mensual de ingresos consultados.
     * @param  [string] $date [fecha de reporte, solo mes y año]
     * @return [json]       [formato para datatables]
     */
    public function reporteIngresosMensualData($date=null)    
    {      
       
        if ( $date == null ) {
            $date = Carbon::now()->format('m-Y');
        }       

        $ingresos = $this->ingresosMensual($date);//trait
        return response()->json(['data' => $ingresos]);
    }

    /**
     *  Muestra reporte general mensual de Ingresos
     *
     * @return \Illuminate\Http\Response
     */
    public function reporteIngresosAnual()    
    {      
        $year = strftime('%Y',strtotime('now'));       
        $last_year = strftime('%Y',strtotime('first day of -1 year'));
        $meses  = config('constants.meses_name');
        $api = url('/chart-ingreso-anual-ajax');
        $chart = new PruebaChart;
        $chart->labels($meses)->load($api);
          
        return view('reporte_general.ingresos.anual.index',compact('year','last_year','chart'));
    }

    /**
     *  Muestra reporte general mensual de Ingresos
     *
     * @return \Illuminate\Http\Response
     */
    public function reporteIngresosAnualAjax(Request $request)    
    {      
        $year = $request->has('year') ? $request->year : date('Y');
        $meses  = config('constants.meses_name');
        $meses_values = [1,2,3,4,5,6,7,8,9,10,11,12];
        $ingresos_year = collect([]); 
        foreach ($meses_values as $mes) {
            $fecha_ingreso = $mes.'-'.$year;
            $ingresos_fecha_ingreso = $this->ingresosMensual($fecha_ingreso);//trait
            $total_mes = 0;
            $mes_name = $meses[$mes-1];
            foreach ($ingresos_fecha_ingreso as $ingreso_fecha_ingreso) {            
                $total_mes += $ingreso_fecha_ingreso->monto_ingreso;
            }
            $ingreso_year = $total_mes;
            $ingresos_year->push($ingreso_year);
        }
  
        $chart = new PruebaChart; 
        $chart->dataset('Ingresos Anual - '.$year, 'bar', $ingresos_year )->color('#74D46D');

        return $chart->api();
    }


  /**
     * Datos de Reporte general mensual de ingresos consultados.
     * @param  [string] $date [fecha de reporte, solo mes y año]
     * @return [json]       [formato para datatables]
     */
    public function reporteIngresosAnualData($year=null)    
    {      
       
        $year = ($year==null) ? date('Y'): $year;  

        $meses  = config('constants.meses_name');
        $meses_values = [1,2,3,4,5,6,7,8,9,10,11,12];
        $ingresos_year = collect([]); 
        foreach ($meses_values as $mes) {
            $fecha_ingreso = $mes.'-'.$year;
            $ingresos_fecha_ingreso = $this->ingresosMensual($fecha_ingreso);//trait
            $total_mes = 0;
            $mes_name = $meses[$mes-1];
            foreach ($ingresos_fecha_ingreso as $ingreso_fecha_ingreso) {            
                $total_mes += $ingreso_fecha_ingreso->monto_ingreso;
            }
            $ingreso_year =[   
                    'mes'           => $mes,
                    'mes_year'      => $mes_name.' del '.$year,
                    'monto_ingreso' => $total_mes
                    ];  
            $ingreso_year = (object)$ingreso_year; 
            $ingresos_year->push($ingreso_year);
        }
        return response()->json(['data' => $ingresos_year]);
    }
}