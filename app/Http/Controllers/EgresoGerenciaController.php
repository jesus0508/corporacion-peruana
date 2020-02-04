<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\EgresoGerencia;
use Illuminate\Http\Request;

class EgresoGerenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $egresos = EgresoGerencia::all();
        //return $egresos;
        return view('empresa.egresos_gerencia.index',compact('egresos'));
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
        EgresoGerencia::create($request->all());
        return back()->with('alert-type', 'success')->with('status', 'Gasto Gerencia Registrado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\EgresoGerencia  $egresoGerencia
     * @return \Illuminate\Http\Response
     */
    public function show(EgresoGerencia $egresoGerencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\EgresoGerencia  $egresoGerencia
     * @return \Illuminate\Http\Response
     */
    public function edit(EgresoGerencia $egresoGerencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\EgresoGerencia  $egresoGerencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EgresoGerencia $egresoGerencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\EgresoGerencia  $egresoGerencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(EgresoGerencia $egresoGerencia)
    {
        //
    }
}
