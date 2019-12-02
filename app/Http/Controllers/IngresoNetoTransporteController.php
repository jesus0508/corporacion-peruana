<?php

namespace CorporacionPeru\Http\Controllers;

use Illuminate\Http\Request;
use CorporacionPeru\EgresoTransporte;
use CorporacionPeru\IngresoTransporte;
use CorporacionPeru\Transporte;
use DB;

class IngresoNetoTransporteController extends Controller
{
    /**
     *  UNIDADES Ingreso Neto
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $egresos = EgresoTransporte::join('transportes','transportes.id','=',
                                        'egreso_transportes.transporte_id')
                    ->where('transportes.tipo',2)
                    ->select(DB::raw('DATE(fecha_egreso) as day'),
                         'transportes.placa', 'egreso_transportes.fecha_reporte',
                        DB::raw('(-1*sum(monto_egreso)) as monto'))
                    ->groupBy('egreso_transportes.transporte_id' , 'day')
                    ->get();
        //return $egresos;
        $ingresos = IngresoTransporte::join('transportes','transportes.id','=',
                                        'ingreso_transportes.transporte_id')
                    ->where('transportes.tipo','=',2)
                    ->select(DB::raw('DATE(fecha_ingreso) as day'),
                         'transportes.placa','ingreso_transportes.fecha_reporte',
                        DB::raw('(sum(monto_ingreso)) as monto'))
                    ->groupBy('ingreso_transportes.transporte_id' , 'day')
                    ->get();
        $collection = collect([$ingresos, $egresos]);
        $collapsed = $collection->collapse();
        $netos =  $collapsed->all();
        $transportes = Transporte::where('tipo','=',2)->get();
        return view('transporte.reporte.unidades.index',compact('netos','transportes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $egresos = EgresoTransporte::join('transportes','transportes.id','=',
                                        'egreso_transportes.transporte_id')
                    ->select(DB::raw('DATE(fecha_egreso) as day'),
                         'transportes.placa', 'transportes.tipo',
                         'egreso_transportes.fecha_reporte', 
                        DB::raw('(-1*sum(monto_egreso)) as monto'))
                    ->groupBy('egreso_transportes.transporte_id' , 'day')
                    ->get();
        //return $egresos;
        $ingresos = IngresoTransporte::join('transportes','transportes.id','=',
                                        'ingreso_transportes.transporte_id')
                    ->select(DB::raw('DATE(fecha_ingreso) as day'),'transportes.tipo',
                         'transportes.placa','ingreso_transportes.fecha_reporte',
                        DB::raw('(sum(monto_ingreso)) as monto'))
                    ->groupBy('ingreso_transportes.transporte_id' , 'day')
                    ->get();

        $collection = collect([$ingresos, $egresos]);
        $collapsed = $collection->collapse();
        $netos =  $collapsed->all();
        $transportes = Transporte::all();

        return view('transporte.reporte.general.index',compact('netos','transportes'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
