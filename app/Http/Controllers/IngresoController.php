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
     * 
     */
    public function getIngresoByDay($fecha = null){
        if ($fecha==null) {
            //$fecha = Carbon::now()->format('Y-m-d');
         $ingresos = Ingreso::select('ingresos.*');  

        return datatables()->of($ingresos)
            ->addColumn('action', 'ingresos.edit.actions')->make(true);

        }

        $ingresos = Ingreso::where('ingresos.fecha_ingreso',$fecha);  

        return datatables()->of($ingresos)
            ->addColumn('action', 'ingresos.edit.actions')->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::now()->format('d/m/Y');
        return view('ingresos.edit.index', compact('today'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
          
        $categorias = CategoriaIngreso::all();
        $ingresos = Ingreso::orderBy('id','desc')->take(100)->get();
        return view('ingresos.index', compact('categorias','ingresos'));
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
    public function update(StoreIngresoRequest $request,  $id)
    {

        $id = $request->id;       
        Ingreso::findOrFail($id)->update($request->validated());
        return 
        back()->with('alert-type','success')->with('status','Ingreso actualizado con exito');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ingreso::findOrFail($id)->delete();
        return 
         back()->with('alert-type','success')->with('status','Ingreso eliminado con exito');
    }
}
