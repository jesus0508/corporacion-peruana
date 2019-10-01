<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Ingreso;
use Illuminate\Http\Request;
use CorporacionPeru\Categoria;
use CorporacionPeru\CategoriaIngreso;
use Carbon\Carbon;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingresos1 = Ingreso::join('categoria_ingresos','categoria_ingresos.id','=','ingresos.categoria_ingreso_id')
            ->select('ingresos.*','categoria_ingresos.categoria')
            ->get();

        $ingresos2 = CategoriaIngreso::join('pago_clientes','categoria_ingresos.id','=','pago_clientes.categoria_ingreso_id')
            ->select('pago_clientes.codigo_operacion','pago_clientes.monto_operacion as monto_ingreso','pago_clientes.banco','pago_clientes.fecha_operacion as fecha_ingreso','categoria_ingresos.categoria')
            ->get();
        $collection = collect([$ingresos1, $ingresos2]);
        $collapsed = $collection->collapse();
        $ingresos =$collapsed->all(); 

        //return $ingresos;
            
        return view('ingresos_otros.diario.index', compact('ingresos'));
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
     * [ingresosDT description]
     * @return [type] [description]
     */
    public function ingresosDT( $date = null ){
        if ( $date == null ) {
          $date = Carbon::now()->format('Y-m-d');
        }             
        return datatables()
            ->eloquent( Ingreso::query()
                        ->join('categoria_ingresos','categoria_ingresos.id','=','ingresos.categoria_ingreso_id')
                        ->select('ingresos.*','categoria_ingresos.categoria')
                        ->where('fecha_reporte',$date)
                         ) 
                        ->toJson();
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
            Ingreso::create($request->all());
            return response()->json([
                'mensaje' => 'creado'
            ]);
        }
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
    public function edit(Ingreso $ingreso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingreso $ingreso)
    {
        //
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
