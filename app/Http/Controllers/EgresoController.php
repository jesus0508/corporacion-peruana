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


class EgresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
     $egresos = Egreso::join('concepto_gastos','concepto_gastos.id','=','egresos.concepto_gasto_id')
                    ->join('sub_categoria_gastos','sub_categoria_gastos.id','=','concepto_gastos.sub_categoria_gasto_id')
                    ->join('categoria_gastos','categoria_gastos.id','=','sub_categoria_gastos.categoria_gasto_id')
                    ->join('grifos','grifos.id','=','egresos.grifo_id')
                    ->select('egresos.monto_egreso','egresos.fecha_egreso',
                                'grifos.razon_social as grifo',
                                'categoria_gastos.categoria',
                                'sub_categoria_gastos.subcategoria',
                                'concepto_gastos.concepto'
                            )
                    ->get();
        $grifos         = Grifo::all();
        //return strftime( '%d',strtotime('-1 day'));

        $semana = config('constants.semana_name');
        $today = $semana[strftime( '%w',strtotime('now') )];
        $today_date = strftime( '%d/%m/%Y',strtotime('now') );
        $yesterday = $semana[strftime( '%w',strtotime('-1 day') )];
        $yesterday_date = strftime( '%d/%m/%Y',strtotime('-1 day') );
        //return $yesterday_date;
        return view('reportes_gastos_grifo.diario.index',compact('egresos','grifos','today','yesterday','today_date','yesterday_date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $egresos = Egreso::select( 
                DB::raw('DATE(fecha_egreso) as day') ,DB::raw('MONTH(fecha_egreso) as month'),DB::raw('YEAR(fecha_egreso) as year'),DB::raw('sum(monto_egreso) as subtotal')
                )
                ->groupBy('day')
                //->orderBy('id','DESC')
                ->get();
        $this_year = strftime( '%Y',strtotime('now') );
        $semana       =  config('constants.semana_name');//constant            
        $meses        = config('constants.meses_name');
        $month_actual = $meses[strftime( '%m',strtotime('now') )-1];
        $month_actual_date = $month_actual.' '.$this_year;
        $last_month = $meses[strftime( '%m',strtotime('first day of -1 month') )-1];
        $last_month_date = $last_month.' '.$this_year;

        return view('reportes_gastos_grifo.mensual.index',compact('egresos','month_actual','last_month','semana','month_actual_date','last_month_date'));

    }
    /**
     * [reporte_gastos_anual description]
     * @return [type] [description]
     */
    public function reporte_gastos_anual(){
        $anios=config('constants.anios');
        $egresos = Egreso::select( 
                DB::raw('DATE(fecha_egreso) as day') ,DB::raw('MONTH(fecha_egreso) as month'),DB::raw('YEAR(fecha_egreso) as year'),DB::raw('sum(monto_egreso) as subtotal')
                )
                ->groupBy('month')
                ->get();
        $meses        = config('constants.meses_name');
        $year = strftime('%Y',strtotime('now'));       
        $last_year = strftime('%Y',strtotime('first day of -1 year'));

        $p1 =   Egreso::select( 
                DB::raw('sum(monto_egreso) as subtotal','MONTH(fecha_egreso) as mes'),DB::raw('MONTH(fecha_egreso) as mes'),'fecha_egreso'
                )
                ->whereYear('fecha_egreso','=','2019')
                ->groupBy('mes')
                ->orderBy('mes')
                ->get();
        $p=collect([]);
        foreach ($p1 as $ps) {
           $p->push($ps->subtotal);       
           
        }
        $g = collect([]);
        foreach ($p1 as $gs) {
         $g->push($meses[$gs->mes-1]); 
        }
        //$g = $g->sort();
        //return $g;
        $chart = new PruebaChart();
        $chart->dataset('GASTOS 2019', 'bar', $p)->color('#74D46D');
        $chart->labels($g);
       // $chart->labels($g->values()->all());
        //$chart->displayAxes(false);
        //$chart->labelsRotation(45.5);
        //$chart->displayLegend(true);

        return view('reportes_gastos_grifo.anual.index',compact('egresos','anios','year','last_year','chart') );
    }

    /**
     * [reporte_gastos_general description]
     * @return [type] [description]
     */
    public function reporte_gastos_general(){
        $egresos = Egreso::select( 
                DB::raw('YEAR(fecha_egreso) as year'),DB::raw('sum(monto_egreso) as subtotal')
                )
                ->groupBy('year')
                ->orderBy('year')
                ->get();


        $values = collect([]);
        $labels = collect([]);
        foreach ($egresos as $ps) {
            $values->push($ps->subtotal);
            $labels->push($ps->year);            
        }
        $chart = new GastoAnualChart();
        $chart->labels($labels);
        $chart->dataset('GASTOS TOTALES - GRIFOS', 'bar',$values);
        $chart->theme('light');
        $chart->export(true,'Gastos Generales');



        //return $g;

        return view('reportes_gastos_grifo.general.index',compact('egresos','chart') );
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
                            'egresos.id',
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
