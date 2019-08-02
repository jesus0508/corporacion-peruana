<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Transportista;
use CorporacionPeru\Vehiculo;
use Illuminate\Http\Request;
use CorporacionPeru\Http\Requests\StoreTransportistaRequest;

class TransportistaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transportistas_tbl = Transportista::all()->sortBy('id');
        $transportistas = Transportista::all();
        return view('transportistas.index',compact('transportistas_tbl','transportistas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('transportistas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Transportista::create($request->all());
        return back()->with('alert-type','success')->with('status','Transportista Registrado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehiculo = Vehiculo::with('transportista')->where('id','=',$id)->first();
         
        return $vehiculo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id2=$request->id;
        Transportista::findOrFail($id2)->update($request->all());
        return  back()->with('alert-type','success')->with('status','Transportista editado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contador = 0;
        $vehiculos=Vehiculo::where('transportista_id',"=",$id)->get();
        $contador = count($vehiculos);

        if( $contador <= 0){
             Transportista::destroy($id);
             return  back()->with('alert-type','warning')->with('status','Transportista borrado con exito');

        } else{

        return  back()->with('alert-type','error')->with('status','No se puede borrar, elimine su vehiculo primero');
        }
    }
}
