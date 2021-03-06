<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\CategoriaEgreso;
use Illuminate\Http\Request;

class CategoriaEgresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = CategoriaEgreso::all();
        return  view('salidas.categorias.index', compact('categorias'));
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
        CategoriaEgreso::create( $request->validate([
            'categoria' => 'required|max:255',
        ]) );

        return back()->with('alert-type', 'success')->with('status', 'Categoria registrada con exito');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\CategoriaEgreso  $categoriaEgreso
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request )
    {
        $id = $request->id;
        CategoriaEgreso::findOrFail($id)->update( $request->validate([
            'categoria' => 'required|max:255',            
        ]) );
        return back()->with('alert-type', 'success')->with('status', 'Categoria actualizada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\CategoriaEgreso  $categoriaEgreso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $c = CategoriaEgreso::where('id',$id)->with('egresos')->with('pagoProveedores')->first();
        if( count( $c->egresos )      == 0 
        &&  count( $c->pagoProveedores)   == 0 
        && $id !== 1 //para no eliminar cat otras salidas por banco
        ){
          
            CategoriaEgreso::destroy($id);
          
            
            return back()->with(['alert-type' => 'warning', 'status' => 'Categoria eliminada con exito']);
        }else{
            return back()->with(['alert-type' => 'warning', 'status' => 'No se puede eliminar, ya tiene egresos']);
        }    
    }
}
