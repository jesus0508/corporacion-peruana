<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Transporte;
use Illuminate\Http\Request;
use CorporacionPeru\Http\Requests\StoreTransporteRequest;
use CorporacionPeru\IngresoTransporte;
use CorporacionPeru\EgresoTransporte;
use DB;

class TransporteController extends Controller
{
    /**
    * [reporteDiario Todos los transportes description]
    * @return [type] [description]
    */
    public function reporteDiarioTotal(){
               $transportes = Transporte::where('tipo','=',2)->get();
        $ingresos = IngresoTransporte::all();//todos son unidades(2)
        $egresos = EgresoTransporte::with('transporte')
            ->orderBy('fecha_reporte', 'desc')->get();
       return view('transporte.reporte.diario.index',
            compact('transportes','ingresos','egresos'));
    }

    /**
    * [reporteMensual Todos los transportes description]
    * @return [type] [description]
    */
    public function reporteMensualTotal(){

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transportes = Transporte::orderBy('id', 'DESC')->get();
        return view('transporte.gestion.index',compact('transportes'));
    }
    /**
     * [reporteAnualIngresos description]
     * @return [type] [view]
     */
    public function reporteAnualIngresos(){
       
       return view('transporte.reporte.ingresos.anual.index');
    }
    /**
     * [reporteAnualEgresos description]
     * @return [type] [description]
     */
    public function reporteAnualEgresos(){

       return view('transporte.reporte.egresos.anual.index');
    }

    /**
     * [reporteAnualIngresosData description]
     * @return [type] [json datatables format]
     */
    public function reporteAnualIngresosData( $year = null ){

 
        $year = ($year==null) ? date('Y'): $year;  
        $meses  = config('constants.meses_name');
        $meses_values = [1,2,3,4,5,6,7,8,9,10,11,12]; 
        $ingresos_year = collect([]);     
        $ingreso_year =collect([]); 
        $ingreso_year->put('descripcion', 'Ingreso por Buses');                 
        foreach ($meses_values as $mes) {
            $fecha_ingreso = $mes.'-'.$year;
            $ingresos_mes = IngresoTransporte::whereYear('fecha_reporte',$year)
                ->whereMonth('fecha_reporte',$mes)
                ->select(DB::raw('ifnull(sum(monto_ingreso),0) as suma'),'descripcion',
                    DB::raw('MONTH(fecha_reporte) as month') )
                ->groupBy('descripcion','month')
                ->first();                
            $total_mes = ($ingresos_mes)? $ingresos_mes->suma:0.00;
            $ingreso_year->put($mes,$total_mes); 
        }
        $ingreso_year = (object)$ingreso_year; 
        $ingresos_year->push($ingreso_year);

        return response()->json(['data' => $ingresos_year]);
    }

    /**
     * [reporteAnualEngresos  data description]
     * @return [type] [json datatables format]
     */
    public function reporteAnualEgresosData($year = null){
 
        $year = ($year==null) ? date('Y'): $year; 
        $meses  = config('constants.meses_name');
        $meses_values = [1,2,3,4,5,6,7,8,9,10,11,12];
        $ingresos_year = collect([]);         
        $egresos_detalle = EgresoTransporte::select('descripcion')
                ->groupBy('descripcion')
                ->get();
        $egresos_year =collect([]); 
        foreach ($egresos_detalle as $egreso) {
            $detalle = $egreso->descripcion; 
            $egreso_year =collect([]);    
            $egreso_year->put('descripcion', $detalle);                 
            foreach ($meses_values as $mes) {                
                $egresos_mes = EgresoTransporte::whereYear('fecha_reporte',$year)
                    ->whereMonth('fecha_reporte',$mes)
                    ->where('descripcion',$detalle)
                    ->select(DB::raw('ifnull(sum(monto_egreso),0) as suma'),'descripcion',
                        DB::raw('MONTH(fecha_reporte) as month') )
                    ->groupBy('descripcion','month')
                    ->first();              
                $total_mes = ($egresos_mes)? $egresos_mes->suma:0.00;
                $egreso_year->put($mes,$total_mes); 
            }
        $egreso_year = (object)$egreso_year;                  
        $egresos_year->push($egreso_year);
        }
        return response()->json(['data' => $egresos_year]);
    }



    /**
     * Reporte Ingreso Neto Unidades Diario
     * @return [type] []
     */
    public function reporteDiario(){
        //unidades=2
        $transportes = Transporte::where('tipo','=',2)->get();
        $ingresos = IngresoTransporte::all();//todos son unidades(2)
        $egresos = EgresoTransporte::with(['transporte' => function ($query) {
            $query->where('tipo', '=', 2);
        }])->orderBy('fecha_reporte', 'desc')->get();
       return view('transporte.reporte.diario.index',
            compact('transportes','ingresos','egresos'));

    }

    /**
     * Reporte Ingreso Neto Unidades Mensual
     * @return [type] []
     */
    public function reporteMensual(){

        $egresos = EgresoTransporte::join('transportes',
                    'transportes.id','=','egreso_transportes.transporte_id')
                    ->where('transportes.tipo','=',2)
                    ->select(DB::raw('MONTH(fecha_reporte) as month'),
                        DB::raw('-1*(sum(monto_egreso)) as monto'),
                        DB::raw('DATE(fecha_reporte) as day'),
                            'egreso_transportes.fecha_reporte',
                            'transportes.placa','fecha_reporte'
                            )
                    ->groupBy('month','transportes.id')
                    ->get();
            
        $ingresos = IngresoTransporte::join('transportes',
                    'transportes.id','=','ingreso_transportes.transporte_id')
                    ->select(DB::raw('MONTH(fecha_reporte) as month'),
                        DB::raw('(sum(monto_ingreso)) as monto'),
                        DB::raw('DATE(fecha_reporte) as day'),
                        'fecha_reporte','transportes.placa'
                            )
                    ->groupBy('month','transportes.id')
                    ->get();
          
            $netos = collect([]); 
            foreach ($ingresos as $ingreso) {
                foreach ($egresos as $egreso ) {
                    if( $ingreso->month == $egreso->month AND $ingreso->transporte_id==$egreso->transporte_id){
                        $consolidado = $egreso->monto + $ingreso->monto;
                        $consolidado = round( $consolidado, 2 );
                        $neto = [   'month'   => $egreso->month, 
                                    'placa' => $egreso->placa,
                                    'monto_ingreso' =>$ingreso->monto,
                                    'day' => $ingreso->day,                                 
                                    'monto_egreso' =>$egreso->monto,
                                    'monto_neto' => $consolidado 
                                ];    
                        $neto = (object)$neto;                  
                        $netos->push($neto);
                    }
                    
                }
                
            }
        $transportes         = Transporte::where('tipo','=',2)->get();
        $semana       =  config('constants.semana_name');//constant week                  
        $this_year = strftime( '%Y',strtotime('now') );
        $meses        = config('constants.meses_name');
        $month_actual = $meses[strftime( '%m',strtotime('now') )-1];
        $month_actual_date = $month_actual.' '.$this_year;
        $last_month = $meses[strftime( '%m',strtotime('first day of -1 month') )-1];
        $last_month_date = $last_month.' '.$this_year;
       // return $netos;

        return view('transporte.reporte.mensual.index',compact('netos','transportes','month_actual','last_month','semana','month_actual_date','last_month_date'));

    }

    /**
     * Reporte Ingreso Neto Unidades Diario
     * @return [type] []
     */
    public function reporteAnual(){
        $transportes = Transporte::where('tipo','=',2)->get();
        $ingresos = IngresoTransporte::all();
        $egresos = EgresoTransporte::all();

        return view('transporte.reporte.diario.index',compact('transportes','ingresos','egresos'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransporteRequest $request)
    {
        Transporte::create($request->validated());
        return back()->with(['alert-type' => 'success', 'status' => 'Transporte creado con exito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Transporte  $transporte
     * @return \Illuminate\Http\Response
     */
    public function show(Transporte $transporte)
    {
       return $transporte;
       // return response()->json(['transporte' => $transporte]);;
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Transporte  $transporte
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTransporteRequest $request)
    {
        $id = $request->id;
        Transporte::findOrFail($id)->update($request->validated());
        return  back()->with('alert-type', 'success')->with('status', 'Transporte editado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\Transporte  $transporte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transporte $transporte)
    {
        $exists = EgresoTransporte::where('transporte_id', $transporte->id)->exists();
        if ($exists) {
            return  back()->with('alert-type', 'warning')->with('status', 'Transporte tiene ingresos y/o egresos asociados');
        }
        $transporte->delete();
        return  back()->with('alert-type', 'success')->with('status', 'Transporte eliminado con exito');
    }
}
