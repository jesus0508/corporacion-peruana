<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\CategoriaIngreso;
use Illuminate\Http\Request;

class CategoriaIngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = CategoriaIngreso::with('ingresos')->with('pagoClientes')->with('ingresoGrifos')->get();
        return  view('ingresos_otros.categorias.index', compact('categorias'));

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
        CategoriaIngreso::create( $request->validate([
            'categoria' => 'required|max:255',
        ]) );

        return back()->with('alert-type', 'success')->with('status', 'Categoria registrada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\CategoriaIngreso  $categoriaIngreso
     * @return \Illuminate\Http\Response
     */
    public function show(CategoriaIngreso $categoriaIngreso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\CategoriaIngreso  $categoriaIngreso
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoriaIngreso $categoriaIngreso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\CategoriaIngreso  $categoriaIngreso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoriaIngreso $categoriaIngreso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\CategoriaIngreso  $categoriaIngreso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $c = CategoriaIngreso::where('id',$id)->with('ingresos')->with('pagoClientes')->with('ingresoGrifos')->first();
        if( count( $categoria->ingresos )      == 0 
        &&  count( $categoria->ingresoGrifos ) == 0
        &&  count( $categoria->pagoClientes)   == 0 ){
            CategoriaIngreso::destroy($id);
            return back()->with(['alert-type' => 'warning', 'status' => 'Categoria eliminada con exito']);
        }else{
            return back()->with(['alert-type' => 'warning', 'status' => 'No se puede eliminar, ya tiene ingresos']);
        }        
    }
    
}
