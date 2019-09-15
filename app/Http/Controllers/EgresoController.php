<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Egreso;
use Illuminate\Http\Request;
use CorporacionPeru\Grifo;
use DB;
use Carbon\Carbon;
use CorporacionPeru\Charts\PruebaChart;
use CorporacionPeru\Charts\GastoAnualChart;

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
        $date           = Carbon::now();
        $date_yesterday = Carbon::yesterday();
        $semana = array(  //quitar luego
                  "Domingo",
                  "Lunes",
                  "Martes",
                  "Miercoles",
                  "Jueves",
                  "Viernes",
                  "Sábado"
            );
        $today = $semana[strftime( '%w',strtotime($date) )];
        $yesterday = $semana[strftime( '%w',strtotime($date_yesterday) )];

        return view('reportes.diario.diario_gastos',compact('egresos','grifos','today','yesterday'));
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
        $semana       = array("Domingo","Lunes", "Martes","Miércoles",
                         "Jueves","Viernes","Sábado");                    
        $meses        = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $date         = Carbon::now();
        $month_actual = $meses[($date->format('n')) - 1];
        $last_month   = $date->subMonth();
        $last_month   = $meses[($last_month->format('n')) - 1];

        return view('reportes.mensual.index',compact('egresos','month_actual','last_month','semana'));
    }
    /**
     * [reporte_gastos_anual description]
     * @return [type] [description]
     */
    public function reporte_gastos_anual(){
        $anios=array(
        //'2009','2010','2011','2012','2013','2014',
        '2015','2016','2017','2018',
                        '2019','2020','2021','2022','2023','2024','2025','2026');
        $egresos = Egreso::select( 
                DB::raw('DATE(fecha_egreso) as day') ,DB::raw('MONTH(fecha_egreso) as month'),DB::raw('YEAR(fecha_egreso) as year'),DB::raw('sum(monto_egreso) as subtotal')
                )
                ->groupBy('month')
                //->orderBy('id','DESC')
                ->get();
        $meses        = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $date         = Carbon::now();
        $year = $date->format('Y');
        $last_year   = $date->subYear();
        $last_year   = $last_year->format('Y');
        
        $p1 =   Egreso::select( 
                DB::raw('sum(monto_egreso) as subtotal'),DB::raw('MONTH(fecha_egreso) as mes'),
                )
                ->groupBy('mes')
                //->orderBy('id','DESC')
                ->get();
        $p=collect([]);
        foreach ($p1 as $ps) {
           $p->push($ps->subtotal);       
           
        }
        $g = collect([]);
        foreach ($p1 as $gs) {
         $g->push($meses[$gs->mes-1]); 
        }
        $g = $g->sort();
        $chart = new PruebaChart();

        $chart->dataset('GASTOS 2019', 'bar', $p)->color('#74D46D');
        $chart->labels($g->values()->all());
            // ['Enero', 'Febrero', 'Marzo','Abril','Mayo','Junio','Julio',
            //             'Agosto','Septiembre','Octubre','Noviembre','Diciembre']);

        return view('reportes.anual.index',compact('egresos','anios','year','last_year','chart') );
    }

    /**
     * [reporte_gastos_general description]
     * @return [type] [description]
     */
    public function reporte_gastos_general(){
        return "reporte gastos general";
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( $request->ajax() ){

            Egreso::create($request->all());

            return response()->json([
                'mensaje' => 'creado'
            ]);
        }
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
    public function edit(Egreso $egreso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Egreso  $egreso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Egreso $egreso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\Egreso  $egreso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Egreso $egreso)
    {
        //
    }
}
