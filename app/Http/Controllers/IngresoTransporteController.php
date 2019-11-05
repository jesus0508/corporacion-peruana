<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\IngresoTransporte;
use CorporacionPeru\Transporte;
use Illuminate\Http\Request;
use CorporacionPeru\Http\Requests\StoreIngresoTransporteRequest;

class IngresoTransporteController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ingresos = IngresoTransporte::all();
        $transportes = Transporte::where('tipo','=',2)->get();

        return view('transporte.ingresos.index',compact('ingresos','transportes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIngresoTransporteRequest $request)
    {
        IngresoTransporte::create($request->validated());
        return back()->with(['alert-type' => 'success', 'status' => 'Ingreso Transporte creado con exito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\IngresoTransporte  $ingresoTransporte
     * @return \Illuminate\Http\Response
     */
    public function show(IngresoTransporte $ingresoTransporte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\IngresoTransporte  $ingresoTransporte
     * @return \Illuminate\Http\Response
     */
    public function edit(IngresoTransporte $ingresoTransporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\IngresoTransporte  $ingresoTransporte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IngresoTransporte $ingresoTransporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\IngresoTransporte  $ingresoTransporte
     * @return \Illuminate\Http\Response
     */
    public function destroy(IngresoTransporte $ingresoTransporte)
    {
        //
    }
}
