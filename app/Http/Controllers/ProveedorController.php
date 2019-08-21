<?php

namespace CorporacionPeru\Http\Controllers;
use Illuminate\Http\Request;
use CorporacionPeru\Planta;
use CorporacionPeru\Proveedor;
use CorporacionPeru\Http\Requests;
use CorporacionPeru\Http\Requests\StoreProveedorRequest;
use CorporacionPeru\Http\Requests\UpdateProveedorRequest;

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
        $proveedores = Proveedor::all();
        /*$deudas = Proveedor::
            join('plantas','plantas.proveedor_id','=','proveedores.id')
          ->join('pedidos','pedidos.planta_id','=','plantas.id')
          ->select('pedidos.galones','pedidos.costo_galon')
          ->get() ;      
          //return $deudas->where('id',3)->sum('galones');
          //->sum('galones');*/
         

        return view('proveedores.index',compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 

        $proveedores=Proveedor::orderBy('id','asc')->get();

        return view('proveedores.index_create',compact('proveedores'));
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
   
        Proveedor::create($request->validated());


    return  redirect()->action('ProveedorController@index')->with('alert-type','success')->with('status','Proveedor creado con exito');
     

    }

  

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $planta = Planta::findOrFail($id);
        $id = $planta->proveedor_id;
        $proveedor = Proveedor::findOrFail($id);
        return $proveedor;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return $proveedor;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProveedorRequest $request,$id)
    {
        $id=$request->id;
        $proveedor=Proveedor::findOrFail($id);
        $proveedor->update($request->validated());
        return  redirect()->action('ProveedorController@index')->with('alert-type','success')->with('status','Proveedor editado con exito');
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

        if( $contador <= 0){
             Proveedor::destroy($id);
             return  back()->with('alert-type','warning')->with('status','Proveedor borrado con exito');

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