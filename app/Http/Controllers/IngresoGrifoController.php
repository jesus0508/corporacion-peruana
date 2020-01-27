<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Grifo;
use CorporacionPeru\IngresoGrifo;
use Illuminate\Http\Request;
use CorporacionPeru\Http\Requests\StoreIngresoGrifoRequest;
use Log;

class IngresoGrifoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ingresoGrifos = IngresoGrifo::all();
        $grifos = Grifo::all();
        return view('ingreso_grifos.index', compact('ingresoGrifos','grifos'));
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
    public function store(StoreIngresoGrifoRequest $request)
    {
        //return $request;
        $ingreso = IngresoGrifo::create($request->validated());
        Log::info('Fecha'.$ingreso->fecha_ingreso);
        $grifo = $ingreso->grifo;
        $grifo->stock += $ingreso->calibracion;
        $grifo->save();
        return back()->with(['alert-type' => 'success', 'status' => 'Ingreso registrado con exito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\IngresoGrifo  $ingresoGrifo
     * @return \Illuminate\Http\Response
     */
    public function show(IngresoGrifo $ingresoGrifo)
    {
        //
        return response()->json(['ingresoGrifo' => $ingresoGrifo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\IngresoGrifo  $ingresoGrifo
     * @return \Illuminate\Http\Response
     */
    public function edit(IngresoGrifo $ingresoGrifo)
    {
        //
        return response()->json(['ingresoGrifo' => $ingresoGrifo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\IngresoGrifo  $ingresoGrifo
     * @return \Illuminate\Http\Response
     */
    public function update(StoreIngresoGrifoRequest $request)
    {
        //return $request;
        $ingreso = IngresoGrifo::create($request->validated());
        //$grifo = $ingreso->grifo;
        //$grifo->stock += $ingreso->calibracion;
       // $grifo->save();
        return back()->with(['alert-type' => 'success', 'status' => 'Ingreso actualizado con exito']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\IngresoGrifo  $ingresoGrifo
     * @return \Illuminate\Http\Response
     */
    public function destroy(IngresoGrifo $ingresoGrifo)
    {

        $ingresoGrifo->delete();
        return back()->with(['alert-type' => 'success', 'status' => 'Ingreso Grifo eliminado con exito']);
    }
    /**
     * Ultimo ingreso grifo, lectura inicial
        GRifo datos
     */
    public function getLastIngreso($id)
    {
        $grifo = Grifo::findOrFail($id);
        $ingresoGrifos = IngresoGrifo::where('grifo_id', $id)->latest();
        return response()->json(['ingresoGrifo' => $ingresoGrifos,
                        'grifo'=>$grifo]);

    }
}
