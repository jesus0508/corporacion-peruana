<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\SubCategoriaGasto;
use Illuminate\Http\Request;

class SubCategoriaGastoController extends Controller
{


    public function getSubCategorias(Request $request){

        if( $request->ajax() ){
            $subcategorias = SubCategoriaGasto::where('categoria_gasto_id',$request->categoria_gasto_id)->get();
            foreach ($subcategorias as $subcategoria) {
                $subcategoriasArray[ $subcategoria->id ] = $subcategoria->subcategoria;
            }
            return response()->json($subcategoriasArray);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        SubCategoriaGasto::create($request->all());

        return back()->with('alert-type', 'success')->with('status', 'Sub-Categoría Registrada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\SubCategoriaGasto  $subCategoriaGasto
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategoriaGasto $subCategoriaGasto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\SubCategoriaGasto  $subCategoriaGasto
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategoriaGasto $subCategoriaGasto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\SubCategoriaGasto  $subCategoriaGasto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategoriaGasto $subCategoriaGasto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\SubCategoriaGasto  $subCategoriaGasto
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategoriaGasto $subCategoriaGasto)
    {
        //
    }
}
