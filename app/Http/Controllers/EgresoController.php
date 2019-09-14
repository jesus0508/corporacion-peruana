<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Egreso;
use Illuminate\Http\Request;
use CorporacionPeru\Grifo;


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
        $grifos = Grifo::all();
       // $yesterday = date("Y-m-d", strtotime( '-1 days' ) );
        //$countYesterday = Timer::whereDate('created_at', $yesterday )->get();
        return view('reportes.diario.diario_gastos',compact('egresos','grifos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'reportes Mensuales';
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
