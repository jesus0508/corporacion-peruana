<?php

namespace CorporacionPeru\Http\Controllers;

use Illuminate\Http\Request;
use CorporacionPeru\CategoriaGasto;
use DB;

class CategoriaGastoController extends Controller
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
        CategoriaGasto::create($request->all());

        return back()->with('alert-type', 'success')->with('status', 'Categoría Registrada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\ConceptoGasto  $conceptoGasto
     * @return \Illuminate\Http\Response
     */
    public function show($cod)
    {
       $categoria = CategoriaGasto::where('codigo',$cod)->first();
       return $categoria;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\ConceptoGasto  $conceptoGasto
     * @return \Illuminate\Http\Response
     */
    public function edit(ConceptoGasto $conceptoGasto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\ConceptoGasto  $conceptoGasto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        CategoriaGasto::findOrFail($id)->update($request->all());
        return  back()->with('alert-type', 'success')->with('status', 'Categoria editada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\ConceptoGasto  $conceptoGasto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)    
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        CategoriaGasto::truncate();     
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

       return  back()->with('alert-type','warning')->with('status','Categoría borrada con exito');
    }
}
