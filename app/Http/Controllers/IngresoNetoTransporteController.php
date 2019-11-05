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
                                        'egreso_transportes.id')
                    ->where('transportes.tipo',2)
                    ->select(DB::raw('DATE(fecha_egreso) as day'),
                         'transportes.placa', 'egreso_transportes.fecha_reporte',
                        DB::raw('(sum(monto_egreso)) as monto'))
                    ->groupBy('egreso_transportes.transporte_id' , 'day')
                    ->get();
        //return $egresos;
        $ingresos = IngresoTransporte::join('transportes','transportes.id','=',
                                        'ingreso_transportes.id')
                    ->where('transportes.tipo','=',2)
                    ->select(DB::raw('DATE(fecha_ingreso) as day'),
                         'transportes.placa','ingreso_transportes.fecha_reporte',
                        DB::raw('(sum(monto_ingreso)) as monto'))
                    ->groupBy('ingreso_transportes.transporte_id' , 'day')
                    ->get();
       // return $ingresos;
        //AGREGAR PARA QUE SE VEA CUANDO NO HAY EGRESOS DE UN TRANSPORTE
            $netos = collect([]); 
            foreach ($ingresos as $ingreso) {
                foreach ($egresos as $egreso ) {
                    if( $ingreso->day == $egreso->day AND $ingreso->placa==$egreso->placa){
                        $consolidado = $ingreso->monto-$egreso->monto;
                        $consolidado = round( $consolidado, 2 );
                        $neto =[    'day'   => $egreso->day,
                                    'fecha_reporte' => $ingreso->fecha_reporte, 
                                    'placa' => $egreso->placa,
                                    'monto_ingreso' =>$ingreso->monto,
                                 
                                    'monto_egreso' =>$egreso->monto,
                                    'monto_neto' => $consolidado ];    
                        $neto = (object)$neto;                  
                        $netos->push($neto);
                    }
                    
                }
                
            }
     //   return $netos;
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
        //
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
