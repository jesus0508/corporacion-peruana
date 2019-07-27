<?php

namespace CorporacionPeru\Http\Controllers;
use Illuminate\Http\Request;
use CorporacionPeru\Planta;
use CorporacionPeru\Proveedor;
use CorporacionPeru\Http\Requests;
use CorporacionPeru\Http\Requests\StoreProveedorRequest;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $proveedores=Proveedor::all();
        return view('proveedores.index',compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         return view('proveedores.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProveedorRequest $request)
    {
        //
          Proveedor::create($request->validated());

        return  back()->with('alert-type','success')->with('status','Proveedor creado con exito');
    }

  

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedor $proveedor)
    {
        //
        return $proveedor;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Proveedor $proveedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProveedorRequest $request,$id)
    {
        $id=$request->id;
        //$var = $proveedor->get('id');
        //$jsonProv = $var[0] ; 
        $proveedor=Proveedor::findOrFail($id);
        $proveedor->update($request->validated());
        return  back()->with('alert-type','success')->with('status','proveedor editado con exito');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contador = 0;
        $plantas=Planta::where('proveedor_id',"=",$id)->get();
        $contador = count($plantas);


            //$var = $proveedor->get('id');
             //$jsonProv = $var[0] ;
            // $id=$request->id;
        if( $contador <= 0){
             Proveedor::destroy($id);
             return  back()->with('alert-type','success')->with('status','Proveedor borrado con exito');

        } else{

        return  back()->with('alert-type','error')->with('status','No se puede borrar, elimine su planta primero');
        }
       
    }

    public function datatable(){
        /*$plantas2 = Proveedor::Join('plantas','proveedores.id','=','plantas.proveedor_id')
            ->select(array('*'));  */
            $plantas = Proveedor::query();

        return 
                datatables()->of($plantas)
         
                ->addColumn('btn','actions/proveedor')
                
                ->rawColumns(['btn'])
                ->toJson();
    }






}