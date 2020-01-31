<?php

namespace CorporacionPeru\Http\Controllers;

use Illuminate\Http\Request;
use CorporacionPeru\Egreso;
use CorporacionPeru\Grifo;
use CorporacionPeru\IngresoGrifo;
use Carbon\Carbon;
use DB;
use CorporacionPeru\Traits\ReporteIngresosGrifos;
use CorporacionPeru\Charts\PruebaChart;

class IngresoNetoGrifoController extends Controller
{
    use ReporteIngresosGrifos;

    /**
     * [ingresoDetalladoGrifo description]
     * @return [type] [description]
     */
    public function ingresoDetalladoGrifo(){
      
        $grifos         = Grifo::all();
        $semana = config('constants.semana_name');
        $semana = config('constants.semana_name');
        $today = $semana[strftime( '%w',strtotime('now') )];
        $today_date = strftime( '%d/%m/%Y',strtotime('now') );
        $yesterday = $semana[strftime( '%w',strtotime('-1 day') )];
        $yesterday_date = strftime( '%d/%m/%Y',strtotime('-1 day') );

        return view('reporte_ganancia_grifo.reporte_detallado.index',compact('grifos','today','yesterday','today_date','yesterday_date'));
    }

    /**
     * [ingresoDetalladoGrifoData description]
     * @param  [type] $date [description]
     * @return [type]       [format datatbles]
     */
    public function ingresoDetalladoGrifoDataI($date = null){
                    
        if ( $date == null ) {
            $date = Carbon::now()->format('Y-m-d');
        } 
            $ingresos = IngresoGrifo::join('grifos','grifos.id','=','ingreso_grifos.grifo_id')
                    ->where('fecha_ingreso',$date)
                    ->select('ingreso_grifos.fecha_ingreso',
                        'ingreso_grifos.fecha_reporte',
                        'grifos.razon_social as grifo',
                     'ingreso_grifos.monto_ingreso as monto' )
                    ->get();
        return response()->json(['data' => $ingresos]);
    }
 /**
     * [ingresoDetalladoGrifoData description]
     * @param  [type] $date [description]
     * @return [type]       [format datatbles]
     */
    public function ingresoDetalladoGrifoDataE($date = null){
                    
        if ( $date == null ) {
            $date = Carbon::now()->format('Y-m-d');
        }

        $egresos = Egreso::join('concepto_gastos','concepto_gastos.id','=','egresos.concepto_gasto_id')
            ->join('sub_categoria_gastos','sub_categoria_gastos.id','=','concepto_gastos.sub_categoria_gasto_id')
            ->join('categoria_gastos','categoria_gastos.id','=','sub_categoria_gastos.categoria_gasto_id')
            ->join('grifos','grifos.id','=','egresos.grifo_id')
            ->where('egresos.fecha_egreso',$date)
            ->select( 
                'fecha_egreso','fecha_reporte',
                'grifos.razon_social as grifo',
                DB::raw('-1*(monto_egreso) as monto') , 'concepto_gastos.concepto as detalle'
                    )
            ->get();   
        return response()->json(['data' => $egresos]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grifos = Grifo::all();
        $semana = config('constants.semana_name');
        $today  = $semana[strftime( '%w',strtotime('now') )];
        $today_date = strftime( '%d/%m/%Y',strtotime('now') );
        $yesterday = $semana[strftime( '%w',strtotime('-1 day') )];
        $yesterday_date = strftime( '%d/%m/%Y',strtotime('-1 day') );

        return view('reporte_ganancia_grifo.neto.diario.index',compact('grifos','today','yesterday','today_date','yesterday_date'));
    }


    /**
     * Datos  diario de ingresos grifo consultados.
     * @param  [date] $date [fecha de egreso]
     * @return [json]       [formato para datatables]
     */
    public function reporteIngresoGrifoNetoDiarioData($date = null){
        if ( $date == null ) {
            $date = Carbon::now()->format('Y-m-d');
        }             
        $ingresos = $this->ingresosGrifosNetoDiario($date);//trait
        return response()->json(['data' => $ingresos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $grifos = Grifo::all();

        return view('reporte_ganancia_grifo.neto.mensual.index',compact('month_actual','last_month','grifos',
            'month_actual_date','last_month_date','month_actual_date_my','last_month_date_my'));
    }

    /**
     * [reporteIngresoGrifoNetoMensualData description]
     * @param  [type] $date [date (Y-m))]
     * @return [type]       [description]
     */
    public function reporteIngresoGrifoNetoMensualData($date = null){
        if ( $date == null ) {
            $date = Carbon::now()->format('m-Y');            
        }   
        list($numero_mes, $year) = explode("-", $date);         
        $egresos = $this->ingresosGrifosNetoMensual($date);//trait
        
        return response()->json(['data' => $egresos]);
    }

    /**
     * [reporteIngresoGrifoNetoMensual description]
     * @return [type]       [description]
     */
    public function reporteIngresoGrifoNetoAnual(){
       
        $year = strftime('%Y',strtotime('now'));       
        $last_year = strftime('%Y',strtotime('first day of -1 year'));
        $meses  = config('constants.meses_name');
        $api = url('/chart-ingresos-grifos-anual-ajax');
        $chart = new PruebaChart;
        $chart->labels($meses)->load($api);
        $grifos = Grifo::all();
        $grifos_col = collect([]); 
        foreach ($grifos as $grifo) {            ;
            $grifos_col->push($grifo->razon_social);
        }
        $api_chart_grifos = url('/chart-ingresos-x-grifo-anual-ajax');
        $chart_grifos = new PruebaChart;
        $chart_grifos->labels($grifos_col)->load($api_chart_grifos);
        return view('reporte_ganancia_grifo.neto.anual.index',compact('year','last_year','chart','chart_grifos'));
    } 

     /**
     * [reporteIngresoGrifoNetoMensualData description]
     * @param  [type] $year [year (Y))]
     * @return [type]       [description]
     */
    public function reporteIngresoGrifoNetoAnualData($year = null){
       
       $year = ($year==null) ? date('Y'): $year;  
        $meses  = config('constants.meses_name');
        $meses_values = [1,2,3,4,5,6,7,8,9,10,11,12];
        $ingresos_neto_grifos = collect([]); 
        foreach ($meses_values as $mes) {
            $fecha_ingreso = $mes.'-'.$year;
            $ingresos_fecha_ingreso = $this->ingresosGrifosNetoMensual($fecha_ingreso);//trait
            $total_mes = 0;
            $mes_name = $meses[$mes-1];
            foreach ($ingresos_fecha_ingreso as $egreso_fecha_ingreso) {            
                $total_mes += $egreso_fecha_ingreso->monto_neto;
            }
            $ingreso_neto_year =[   
                    'mes'           => $mes,
                    'mes_year'      => $mes_name.' del '.$year,
                    'monto_egreso' => $total_mes
                    ];  
            $ingreso_neto_year = (object)$ingreso_neto_year; 
            $ingresos_neto_grifos->push($ingreso_neto_year);
        }
        return response()->json(['data' => $ingresos_neto_grifos]);
    } 

    /**
     *  Datos para chart Egresos Grifo Anual
     *
     * @return \Illuminate\Http\Response
     */
    public function reporteIngresoGrifoNetoAnualAjax(Request $request)    
    {      
        $year = $request->has('year') ? $request->year : date('Y');
        $meses  = config('constants.meses_name');
        $meses_values = [1,2,3,4,5,6,7,8,9,10,11,12];
        $ingresos_neto_grifos = collect([]); 
        foreach ($meses_values as $mes) {
            $fecha_ingreso = $mes.'-'.$year;
            $ingresos_fecha_ingreso = $this->ingresosGrifosNetoMensual($fecha_ingreso);//trait
            $total_mes = 0;
            foreach ($ingresos_fecha_ingreso as $egreso_fecha_ingreso) {            
                $total_mes += $egreso_fecha_ingreso->monto_neto;
            }
            $ingresos_neto_grifos->push($total_mes);
        }
        $chart = new PruebaChart; 
        $chart->dataset('Ingresos Neto Anual - '.$year, 'bar', $ingresos_neto_grifos )->color('#74D46D');

        return $chart->api();
    }

      /**
     * Datos de Reporte general mensual de ingresos consultados.
     * @param  [string] $date [fecha de reporte, solo mes y año]
     * @return [json]       [formato para datatables]
     */
    public function reporteIngresosNetoXGrifoAnualData($year=null)    
    {      
       
        $year = ($year==null) ? date('Y'): $year;  
        $netos = $this->ingresosGrifoNetoAnual($year);
        return response()->json(['data' => $netos]);
    }

   /**
     * Datos de Reporte general mensual de ingresos consultados.
     * @param  [string] $date [fecha de reporte, solo mes y año]
     * @return [json]       [formato para datatables]
     */
    public function reporteIngresosNetoXGrifoAnualAjax(Request $request)    
    {      
       
        $year = $request->has('year') ? $request->year : date('Y');
        $ingresos_year = $this->ingresosGrifoNetoAnual($year);

        $ingresos_col = collect([]); //ingresos en collection
        foreach ($ingresos_year as $ingreso) {            
            $ingresos_col->push($ingreso->monto_neto);
        } 
    
        $chart = new PruebaChart; 
        $chart->dataset('Ingresos netos por Grifo Anual - '.$year, 'bar', $ingresos_col )->color('#74D46D');
        return $chart->api();
    }


}
