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
      
        $transportistas = Transportista::all();
        return view('transportistas.index_create',compact('transportistas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransportistaRequest $request)
    {
        Transportista::create($request->validated());
        $transportistas_tbl = Transportista::all()->sortBy('id');

        return redirect()->route('transportista.index')->with('alert-type','success')->with('status','Transportista Registrado con exito')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showVehiTrans($id)
    {
        $vehiculo = Vehiculo::with('transportista')->where('id','=',$id)->first();
         
            return $vehiculo;

    }

        public function show($id)
    {

            $transportista = Transportista::findOrFail($id)->with('vehiculos')->first();
                return $transportista;
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
    public function update(StoreTransportistaRequest $request, $id)
    {
        $id2=$request->id;
        Transportista::findOrFail($id2)->update($request->validated());

        return redirect()->action('TransportistaController@index')->with('alert-type','success')->with('status','Transportista editado con exito')->withInput($request->all);
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
