<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Salida;
use CorporacionPeru\Cuenta;
use Illuminate\Http\Request;
use CorporacionPeru\CategoriaEgreso;
use Carbon\Carbon;
use DB;

class SalidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $egresos1 = Salida::join('categoria_egresos','categoria_egresos.id','=','salidas.categoria_egreso_id')
            ->select('salidas.*','categoria_egresos.categoria')
            ->get();

        $egresos2 = CategoriaEgreso::join('pago_proveedors','categoria_egresos.id','=','pago_proveedors.categoria_egreso_id')
            ->select('pago_proveedors.codigo_operacion',
                'pago_proveedors.monto_operacion as monto_egreso',
                'pago_proveedors.banco',
                'pago_proveedors.fecha_operacion as fecha_egreso',
                'categoria_egresos.categoria','pago_proveedors.id as esPagoProveedor')
            ->get(); 
        $collection = collect([$egresos1, $egresos2]);
        $collapsed = $collection->collapse();
        $egresos =$collapsed->all(); 

        return view('salidas.diario.index', compact('egresos'));
    }

    /**
     * [reporte de ingresos de un día,
     * al momento de registrar otros ingresos del mismo día]
     * @return [type] [description]
     */
    public function egresosDT( $date = null ){
        if ( $date == null ) {
          $date = Carbon::now()->format('Y-m-d');
        }             
        return datatables()
            ->eloquent( Salida::query()
                        ->join('categoria_egresos','categoria_egresos.id','=','salidas.categoria_egreso_id')
                        ->select('salidas.*','categoria_egresos.categoria')
                        ->where('fecha_reporte',$date)
                         ) 
                        ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cuentas = Cuenta::all();
        $categorias = CategoriaEgreso::all();
        return view('salidas.index', compact('categorias','cuentas'));
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
            Salida::create($request->all());
            return response()->json([
                'mensaje' => 'creado'
            ]);
        }
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
