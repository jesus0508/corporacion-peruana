<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Trabajador;
use Illuminate\Http\Request;
use CorporacionPeru\Http\Requests\StoreTrabajadorRequest;

class TrabajadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trabajadores=Trabajador::all();
        return view('trabajadores.index',compact('trabajadores'));
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
    public function store(StoreTrabajadorRequest $request)
    {
        //
        Trabajador::create($request->validated());
        return back()->with(['alert-type'=>'success','status'=>'Trabajador creado con exito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Trabajador  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function show(Trabajador $trabajador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\Trabajador  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function edit(Trabajador $trabajador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Trabajador  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTrabajadorRequest $request, Trabajador $trabajador)
    {
        //
        $id=$request->id;
        Trabajador::findOrFail($id)->update($request->validated());
        return back()->with(['alert-type'=>'success','status'=>'Trabajador editado con exito']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\Trabajador  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trabajador $trabajador)
    {
        //
        $trabajador->delete();
        return back()->with(['alert-type'=>'warning','status'=>'Trabajador eliminado con exito']);
    }
}
