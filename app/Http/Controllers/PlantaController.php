<?php

namespace CorporacionPeru\Http\Controllers;

use Illuminate\Http\Request;
use CorporacionPeru\Planta;
use CorporacionPeru\Proveedor;
use CorporacionPeru\Http\Requests;
use CorporacionPeru\Http\Requests\StorePLantaRequest;

class PlantaController extends Controller
{
	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $proveedor_id = $request->proveedor_id;

        $plantas=Planta::where('proveedor_id',"=",$proveedor_id)->get();


        return  response()->json($plantas);
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
    public function store(StorePlantaRequest $request)
    {
        //
          Planta::create($request->all());
          
        return  back()->with('alert-type','success')->with('status','Planta agregada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Planta  $planta
     * @return \Illuminate\Http\Response proveedor
     */
    public function show($id)
    {
       $proveedor_id = $id;

        $plantas=Planta::where('proveedor_id',"=",$proveedor_id)->get();
       // $planta= $plantas[0]->planta;
        //$planta1= $plantas[0];
    
    // return view('proveedores.plantasShow',compact('plantas'))->toJson();
    //	return  response()->json($plantas[0]->planta);
 		//return $plantas->render();
	return $plantas;
 		
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(StorePlantaRequest $request,  $id)
    {
        
       
        $planta=planta::findOrFail($id);
        $planta->update($request->all());
        return response()->json([
             "mensaje"=>"Actualizacion de registro correcto." 
        ]);
    }

       public function modificar(StorePlantaRequest $request,  $id)
    {
        
       
        $planta=planta::findOrFail($id);
        $planta->update($request->all());
        return  back()->with('alert-type','success')->with('status','planta editada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\Request  $request
     * @return \Illuminate\Http\Response
     */
    //falta Validar
    public function destroy( $id)
    {

            //$id = $request->proveedor_id;
           //  $jsonProv = $var[0] ;
          Planta::destroy($id); 
       

     return  back()->with('alert-type','success')->with('status','Planta borrada con exito');
    }
}
