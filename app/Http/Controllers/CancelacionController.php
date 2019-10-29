<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Cancelacion;
use Illuminate\Http\Request;
use CorporacionPeru\Grifo;
use CorporacionPeru\IngresoGrifo;


class CancelacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grifos = Grifo::all();
        $cancelaciones = Cancelacion::join('ingreso_grifos','ingreso_grifos.id','=','cancelacions.ingreso_grifo_id')
            ->join('grifos','grifos.id','=','ingreso_grifos.grifo_id')
            ->select('cancelacions.*','ingreso_grifos.fecha_ingreso','grifos.razon_social','ingreso_grifos.precio_galon','ingreso_grifos.lectura_inicial',
                'ingreso_grifos.lectura_final','ingreso_grifos.monto_ingreso')->get();
        //return $cancelaciones;
        return view('cancelaciones.diario.index',compact('grifos', 'cancelaciones'));
    }
    /**
     * [cancelacion_search description]
     * @return [type] [description]
     */
    public function cancelacion_search( $id, $fecha ){//id: id del grifo

        $ingreso_grifo=IngresoGrifo::with('cancelaciones')->where('grifo_id','=',$id)->where('fecha_ingreso',$fecha)->first();
         
         return $ingreso_grifo;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $grifos = Grifo::all();
        $cancelaciones = Cancelacion::all();
        return view('cancelaciones.index',compact('grifos', 'cancelaciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         Cancelacion::create($request->all());
        return back()->with('alert-type', 'success')->with('status', 'Cancelación Registrada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Cancelacion  $cancelacion
     * @return \Illuminate\Http\Response
     */
    public function show(Cancelacion $cancelacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\Cancelacion  $cancelacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Cancelacion $cancelacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Cancelacion  $cancelacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cancelacion $cancelacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\Cancelacion  $cancelacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cancelacion $cancelacion)
    {
        //
    }
}
