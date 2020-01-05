<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\TrasladoGalones;
use Illuminate\Http\Request;
use CorporacionPeru\Proveedor;
use CorporacionPeru\Stock;
use CorporacionPeru\Http\Requests\StoreTrasladoGalonesRequest;


class TrasladoGalonesController extends Controller
{


    public function reporteGrifosClientes(){

        $traslados=TrasladoGalones::with('proveedor')->orderBy('id', 'DESC')->get();
        return view('traslado_galones.reportes.grifos.index',
            compact('traslados'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $traslados=TrasladoGalones::with('proveedor')->orderBy('id', 'DESC')->get();
        $proveedores = Proveedor::orderBy('id', 'DESC')->get();
        return view('traslado_galones.reportes.proveedores.diario.index',
            compact('traslados','proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedores = Proveedor::orderBy('id', 'DESC')->get();
        $traslados=TrasladoGalones::with('proveedor')->orderBy('id', 'DESC')->get();
        return view('traslado_galones.index',
            compact('proveedores','traslados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrasladoGalonesRequest $request)
    {
        //return $request;
        TrasladoGalones::create($request->validated());
        return back()->with('alert-type', 'success')->with('status', 'Registrado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\TrasladoGalones  $trasladoGalones
     * @return \Illuminate\Http\Response
     */
    public function show(TrasladoGalones $trasladoGalones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\TrasladoGalones  $trasladoGalones
     * @return \Illuminate\Http\Response
     */
    public function edit(TrasladoGalones $trasladoGalones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\TrasladoGalones  $trasladoGalones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TrasladoGalones $trasladoGalones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\TrasladoGalones  $trasladoGalones
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrasladoGalones $trasladoGalones)
    {
        //
    }
}
