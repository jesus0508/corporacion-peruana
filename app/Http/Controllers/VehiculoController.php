<?php

namespace CorporacionPeru\Http\Controllers;

use Illuminate\Http\Request;
use CorporacionPeru\Transportista;
use CorporacionPeru\Vehiculo;
use CorporacionPeru\Http\Requests\StoreVehiculoRequest;

class VehiculoController extends Controller
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
    public function create()
    {
        $transportistas = Transportista::all()->sortByDesc('id');
        return view('vehiculos.create',compact('transportistas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVehiculoRequest $request)
    {
         Vehiculo::create($request->all());
        $id = $request->transportista_id;

        $vehiculos=Vehiculo::where('transportista_id',"=",$id)->get();
        $transportista = Transportista::findOrFail($id);

      //  return view('vehiculos.index',compact('vehiculos','transportista'));
        return redirect()->route('vehiculo.show',compact('id'))->with('alert-type','success')->with('status','Vehiculo Asignado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehiculos=Vehiculo::where('transportista_id',"=",$id)->get();
        $transportista = Transportista::findOrFail($id);

        return view('vehiculos.index',compact('vehiculos','transportista'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        return $vehiculo;
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
         $id=$request->id;
        Vehiculo::findOrFail($id)->update($request->all());
        return  back()->with('alert-type','success')->with('status','Vehiculo editado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vehiculo::destroy($id);
             return  back()->with('alert-type','warning')->with('status','Vehiculo borrado con exito');
    }
}
