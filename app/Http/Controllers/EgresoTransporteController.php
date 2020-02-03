<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\EgresoTransporte;
use CorporacionPeru\Transporte;
use Illuminate\Http\Request;
use CorporacionPeru\Http\Requests\StoreEgresoTransporteRequest;

class EgresoTransporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function placas_transporte($idTipo){

        $transporte = null;
        if ($idTipo!=-1) {
            $transporte = Transporte::where('tipo','=',$idTipo)->select('id', 'placa as text')->get();        
            return response()->json(['transporte' => $transporte]);
        }
        return   response()->json(['transporte' => $transporte]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $egresos = EgresoTransporte::select('egreso_transportes.*','fecha_reporte as date_reporte')->get();
        $transportes = Transporte::all();
        return view('transporte.egresos.index',compact('egresos','transportes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEgresoTransporteRequest $request)
    {
        EgresoTransporte::create($request->validated());
        return back()->with(['alert-type' => 'success', 'status' => 'Ingreso Transporte creado con exito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\EgresoTransporte  $egresoTransporte
     * @return \Illuminate\Http\Response
     */
    public function show(EgresoTransporte $egresoTransporte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\EgresoTransporte  $egresoTransporte
     * @return \Illuminate\Http\Response
     */
    public function edit(EgresoTransporte $egresoTransporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\EgresoTransporte  $egresoTransporte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EgresoTransporte $egresoTransporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\EgresoTransporte  $egresoTransporte
     * @return \Illuminate\Http\Response
     */
    public function destroy(EgresoTransporte $egresoTransporte)
    {
        //
    }
}
