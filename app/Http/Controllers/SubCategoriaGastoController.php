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
           // uksort($subcategoriasArray);
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
        if( $request->ajax() ){

            SubCategoriaGasto::create($request->all());
                return response()->json([
                'mensaje' => $request->all()
            ]);
        }
       
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\SubCategoriaGasto  $subCategoriaGasto
     * @return \Illuminate\Http\Response
     */
    public function show($cod)
    {
        $subcategoria = SubCategoriaGasto::where('id',$cod)->with('conceptoGastos')->first();

       return $subcategoria;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\SubCategoriaGasto  $subCategoriaGasto
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategoriaGasto $subCategoriaGasto)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\SubCategoriaGasto  $subCategoriaGasto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        SubCategoriaGasto::findOrFail($id)->update($request->all());
        return  back()->with('alert-type', 'success')->with('status', 'Categoria editada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\SubCategoriaGasto  $subCategoriaGasto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       
        SubCategoriaGasto::findOrFail($request->id)->delete();     
      

       return  back()->with('alert-type','warning')->with('status','SubCategoría borrada con exito');
    }
}
