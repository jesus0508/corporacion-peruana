<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Ingreso;
use Illuminate\Http\Request;
use CorporacionPeru\Categoria;
use CorporacionPeru\Egreso;
use CorporacionPeru\IngresoGrifo;
use CorporacionPeru\CategoriaIngreso;
use CorporacionPeru\MovimientoGrifo;
use CorporacionPeru\IngresoTransporte;
use Carbon\Carbon;
use DB;
use CorporacionPeru\Http\Requests\StoreIngresoRequest;

class IngresoController extends Controller
{
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
    public function create(){
          
        $categorias = CategoriaIngreso::all();
        return view('ingresos_otros.index', compact('categorias'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIngresoRequest $request)
    {
        Ingreso::create($request->validated());

        return back()->with('alert-type','success')->with('status','Ingreso registrado con exito');      
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function show(Ingreso $ingreso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ingreso = Ingreso::where('id',$id)->first();
        $categorias = CategoriaIngreso::all();
        return response()->json(['ingreso' => $ingreso ,                                
                                'categorias' => $categorias ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
       // return $request;
        $id = $request->id;       
       // $request->fecha_ingreso = date('Y-m-d', strtotime($request->fecha_ingreso));
        Ingreso::findOrFail($id)->update($request->all());
        return 
        back()->with('alert-type','success')->with('status','Ingreso actualizado con exito');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingreso $ingreso)
    {
        //
    }
}
