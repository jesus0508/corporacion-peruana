<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Salida;
use CorporacionPeru\Cuenta;
use Illuminate\Http\Request;
use CorporacionPeru\CategoriaEgreso;
use Carbon\Carbon;
use DB;
use CorporacionPeru\Http\Requests\StoreSalidaRequest;

class SalidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::now()->format('d/m/Y');
        return view('salidas.edit.index', compact('today'));
    }

    /**
     * [reporte de salidas de un día,
     * al momento de registrar otros salidas del mismo día]
     * @return [type] [description]
     */
    public function getSalidasByDay( $date = null ){
          if ($date==null) {
         $salidas = Salida::select('salidas.*');  

        return datatables()->of($salidas)
            ->addColumn('action', 'salidas.edit.actions')->make(true);
        }

        $salidas = Salida::where('salidas.fecha_egreso',$date);  
        return datatables()->of($salidas)
            ->addColumn('action', 'salidas.edit.actions')->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cuentas = Cuenta::all();
        $salidas = Salida::orderBy('id','desc')->take(100)->get();
        $categorias = CategoriaEgreso::all();

       // return $salidas;
        return view('salidas.index', compact('salidas','categorias','cuentas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      
        Salida::create($request->all());
        return back()->with('alert-type','success')->with('status','Egreso registrado con exito'); 

    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Salida  $salida
     * @return \Illuminate\Http\Response
     */
    public function show(Salida $salida)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\Salida  $salida
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $salida = Salida::where('id',$id)->first();
        $cuentas = Cuenta::all();
        $categorias = CategoriaEgreso::all();
        return response()->json(['salida' => $salida ,
                                'cuentas' => $cuentas,
                                'categorias' => $categorias ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Salida  $salida
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
       // return $request;
        $id = $request->id;       
        Salida::findOrFail($id)->update($request->all());
        return back()->with('alert-type','success')->with('status','Egreso actualizado con exito');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\Salida  $salida
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salida $salida)
    {
        //
    }
}
