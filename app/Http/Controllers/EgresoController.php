<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Egreso;
use Illuminate\Http\Request;
use CorporacionPeru\Grifo;
use DB;
use Carbon\Carbon;
use CorporacionPeru\Charts\PruebaChart;
use CorporacionPeru\Charts\GastoAnualChart;
use CorporacionPeru\Http\Requests\StoreEgresoRequest;
use CorporacionPeru\Traits\ReporteEgresosGrifos;

class EgresoController extends Controller
{
    use ReporteEgresosGrifos;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
     
        $grifos = Grifo::all();

        $semana = config('constants.semana_name');
        $today = $semana[strftime( '%w',strtotime('now') )];
        $today_date = strftime( '%d/%m/%Y',strtotime('now') );
        $yesterday = $semana[strftime( '%w',strtotime('-1 day') )];
        $yesterday_date = strftime( '%d/%m/%Y',strtotime('-1 day') );
        return view('reportes_gastos_grifo.diario.index',compact('grifos','today','yesterday','today_date','yesterday_date'));
    }

    /**
     * Datos  diario de egresos grifo consultados.
     * @param  [date] $date [fecha de egreso]
     * @return [json]       [formato para datatables]
     */
    public function reporteEgresosGrifoDiarioData($date = null){
        if ( $date == null ) {
            $date = Carbon::now()->format('Y-m-d');
        }             
        $egresos = $this->egresosGrifosDiario($date);//trait
        return response()->json(['data' => $egresos]);
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

        return view('reportes_gastos_grifo.mensual.index',
          compact('month_actual','last_month','grifos',
            'month_actual_date','last_month_date','month_actual_date_my','last_month_date_my'));
    }


    /**
     * Datos de Reporte general mensual de egresos consultados.
     * @param  [string] $date [fecha de reporte, solo mes y año]
     * @return [json]       [formato para datatables]
     */
        public function reporteEgresosGrifoMensualData($date=null)    
    {      
       
         if ( $date == null ) {
            $date = Carbon::now()->format('m-Y');            
        }   
        list($numero_mes, $year) = explode("-", $date);         
        $egresos = $this->egresosGrifosMensual($date);//trait
        return response()->json(['data' => $egresos]);
    }

    /**
     * [reporte_gastos_anual description]
     * @return [type] [description]
     */
    public function reporteEgresosGrifoAnual(){
        
        $year = strftime('%Y',strtotime('now'));       
        $last_year = strftime('%Y',strtotime('first day of -1 year'));
        $meses  = config('constants.meses_name');
        $api = url('/chart-egresos-grifos-anual-ajax');
        $chart = new PruebaChart;
        $chart->labels($meses)->load($api);
        $grifos = Grifo::all();
        $grifos_col = collect([]); 
        foreach ($grifos as $grifo) {            ;
            $grifos_col->push($grifo->razon_social);
        }
        $api_chart_grifos = url('/chart-egresos-x-grifo-anual-ajax');
        $chart_grifos = new PruebaChart;
        $chart_grifos->labels($grifos_col)->load($api_chart_grifos);
        return view('reportes_gastos_grifo.anual.index',compact('year','last_year','chart','chart_grifos'));

    }
    
   /**
     * Datos de Reporte general mensual de ingresos consultados.
     * @param  [string] $date [fecha de reporte, solo mes y año]
     * @return [json]       [formato para datatables]
     */
    public function reporteEgresosGrifoAnualData($year=null)    
    {      
       
       $year = ($year==null) ? date('Y'): $year;  

        $meses  = config('constants.meses_name');
        $meses_values = [1,2,3,4,5,6,7,8,9,10,11,12];
        $egresos_year = collect([]); 
        foreach ($meses_values as $mes) {
            $fecha_egreso = $mes.'-'.$year;
            $egresos_fecha_egreso = $this->egresosGrifosMensual($fecha_egreso);//trait
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
  
   /**
     * Datos de Reporte general mensual de ingresos consultados.
     * @param  [string] $date [fecha de reporte, solo mes y año]
     * @return [json]       [formato para datatables]
     */
    public function reporteEgresosXGrifoAnualData($year=null)    
    {      
       
        $year = ($year==null) ? date('Y'): $year;  
        $egresos_year  = Egreso::join('grifos','grifos.id','=','egresos.grifo_id')
            ->whereYear('fecha_egreso',$year)
            ->select(             
                DB::raw('YEAR(fecha_egreso) as year'),
                DB::raw('sum(monto_egreso) as monto_egreso'),
                'grifos.razon_social as grifo'
                )
                ->groupBy('year','grifo')
                ->get();
        return response()->json(['data' => $egresos_year]);
    }

   /**
     * Datos de Reporte general mensual de ingresos consultados.
     * @param  [string] $date [fecha de reporte, solo mes y año]
     * @return [json]       [formato para datatables]
     */
    public function reporteEgresosXGrifoAnualAjax(Request $request)    
    {      
       
        $year = $request->has('year') ? $request->year : date('Y');

        $egresos_year  = Egreso::join('grifos','grifos.id','=','egresos.grifo_id')
            ->whereYear('fecha_egreso',$year)
            ->select(             
                DB::raw('YEAR(fecha_egreso) as year'),
                DB::raw('sum(monto_egreso) as monto_egreso'),
                'grifos.razon_social as grifo'
                )
                ->groupBy('year','grifo')
                ->get();

        $egresos_col = collect([]); 
        foreach ($egresos_year as $egreso) {            
            $egresos_col->push($egreso->monto_egreso);
        } 
    
        $chart = new PruebaChart; 
        $chart->dataset('Egresos por Grifo Anual - '.$year, 'bar', $egresos_col )->color('#f06292');

        return $chart->api();
    }
    /**
     *  Datos para chart Egresos Grifo Anual
     *
     * @return \Illuminate\Http\Response
     */
    public function reporteEgresosGrifoAnualAjax(Request $request)    
    {      
        $year = $request->has('year') ? $request->year : date('Y');
        $meses  = config('constants.meses_name');
        $meses_values = [1,2,3,4,5,6,7,8,9,10,11,12];
        $egresos_year = collect([]); 
        foreach ($meses_values as $mes) {
            $fecha_egreso = $mes.'-'.$year;
            $egresos_fecha_egreso = $this->egresosGrifosMensual($fecha_egreso);//trait
            $total_mes = 0;
            $mes_name = $meses[$mes-1];
            foreach ($egresos_fecha_egreso as $egreso_fecha_egreso) {            
                $total_mes += $egreso_fecha_egreso->monto_egreso;
            }
            $egreso_year = $total_mes;
            $egresos_year->push($egreso_year);
        }
  
        $chart = new PruebaChart; 
        $chart->dataset('Egresos Grifos Anual - '.$year, 'bar', $egresos_year )->color('#f06292');

        return $chart->api();
    }
    /**
     * Listado CRUD de egresos Grifos
     * @return [type] [description]
     */
    public function listado(){
    
     $egresos = Egreso::join('concepto_gastos','concepto_gastos.id','=','egresos.concepto_gasto_id')
                    ->join('sub_categoria_gastos','sub_categoria_gastos.id','=','concepto_gastos.sub_categoria_gasto_id')
                    ->join('categoria_gastos','categoria_gastos.id','=','sub_categoria_gastos.categoria_gasto_id')
                    ->join('grifos','grifos.id','=','egresos.grifo_id')
                    ->select('egresos.monto_egreso','egresos.fecha_egreso',
                            'egresos.id','fecha_reporte',
                            'grifos.razon_social as grifo',
                            'categoria_gastos.categoria',
                            'sub_categoria_gastos.subcategoria',
                            'concepto_gastos.concepto'
                            )
                    ->get();

        return view( 'gastos.listado.index', compact('egresos') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(StoreEgresoRequest $request)
    {
        Egreso::create($request->validated());
        return back()->with('alert-type','success')->with('status','Egreso registrado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Egreso  $egreso
     * @return \Illuminate\Http\Response
     */
    public function show(Egreso $egreso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\Egreso  $egreso
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $egreso = Egreso::join('concepto_gastos','concepto_gastos.id','=','egresos.concepto_gasto_id')
            ->join('sub_categoria_gastos','sub_categoria_gastos.id','=','concepto_gastos.sub_categoria_gasto_id')
            ->join('categoria_gastos','categoria_gastos.id','=','sub_categoria_gastos.categoria_gasto_id')
            ->join('grifos','grifos.id','=','egresos.grifo_id')
            ->where('egresos.id',$id)
            ->select('egresos.*','grifos.razon_social as grifo',                           
                    'concepto_gastos.codigo', 'categoria_gastos.categoria',
                    'sub_categoria_gastos.subcategoria','concepto_gastos.concepto')   
            ->first();

        $grifos = Grifo::all();
        return response()->json(['egreso' => $egreso ,'grifos' => $grifos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Egreso  $egreso
     * @return \Illuminate\Http\Response
     */
       public function update(StoreEgresoRequest $request, $id)
    {
       
        $id = $request->id;       
        Egreso::findOrFail($id)->update($request->validated());        
        return back()->with('alert-type','success')->with('status','Egreso actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\Egreso  $egreso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Egreso $egreso)
    {
        $egreso->delete();
        
        return back()->with('alert-type','warning')->with('status','Egreso eliminado con exito');
    }
}
