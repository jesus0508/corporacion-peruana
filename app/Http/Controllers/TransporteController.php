<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Transporte;
use Illuminate\Http\Request;
use CorporacionPeru\Http\Requests\StoreTransporteRequest;


class TransporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transportes = Transporte::orderBy('id', 'DESC')->get();
        return view('transporte.gestion.index',compact('transportes'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $transportes = Transporte::orderBy('id', 'DESC')->get();
        // return view('transporte.ingresos.index',compact('transportes'));
    }
    
    public function salida()
    {
        // $transportes = Transporte::orderBy('id', 'DESC')->get();
        // return view('transporte.salidas.index',compact('transportes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransporteRequest $request)
    {
        Transporte::create($request->validated());
        return back()->with(['alert-type' => 'success', 'status' => 'Transporte creado con exito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Transporte  $transporte
     * @return \Illuminate\Http\Response
     */
    public function show(Transporte $transporte)
    {
       return $transporte;
       // return response()->json(['transporte' => $transporte]);;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\Transporte  $transporte
     * @return \Illuminate\Http\Response
     */
    public function edit(Transporte $transporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Transporte  $transporte
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTransporteRequest $request)
    {
        $id = $request->id;
        Transporte::findOrFail($id)->update($request->validated());
        return  back()->with('alert-type', 'success')->with('status', 'Transporte editado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\Transporte  $transporte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transporte $transporte)
    {
        $exists = EgresoTransporte::where('transporte_id', $transporte->id)->exists();
        if ($exists) {
            return  back()->with('alert-type', 'warning')->with('status', 'Transporte tiene ingresos y/o egresos asociados');
        }
        $transporte->delete();
        return  back()->with('alert-type', 'success')->with('status', 'Transporte eliminado con exito');
    }
}
