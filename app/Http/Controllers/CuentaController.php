<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Cuenta;
use Illuminate\Http\Request;

class CuentaController extends Controller
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
        
        Cuenta::create([
            'nro_cuenta'=> $request->abreviacion.' '.$request->nro_cuenta,
            'fondo_actual' => 1500,
            'tipo' => $request->tipo,
            'banco_id' => $request->banco_id
           ]);

        return back()->with('alert-type', 'success')->with('status', 'Cuenta Registrada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function show(Cuenta $cuenta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuenta $cuenta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuenta $cuenta)
    {
        
        $cuenta->update([
            'nro_cuenta'=> $request->abreviacion.' '.$request->nro_cuenta,           
            'tipo' => $request->tipo           
        ]);
        return  back()->with('alert-type', 'success')->with('status', 'Cuenta editada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuenta $cuenta)
    {
        $cuenta->delete();
        return  back()->with('alert-type', 'success')->with('status', 'Cuenta eliminada con exito');
    }
}
