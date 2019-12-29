<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\TrasladoGalones;
use Illuminate\Http\Request;

class TrasladoGalonesController extends Controller
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
        return view('traslado_galones.index');
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
