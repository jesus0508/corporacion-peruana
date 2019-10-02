<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Ingreso;
use Illuminate\Http\Request;
use CorporacionPeru\Categoria;
use CorporacionPeru\CategoriaIngreso;
use Carbon\Carbon;
use DB;
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
        $ingresos_grifos_NORTE = CategoriaIngreso::join('ingreso_grifos','categoria_ingresos.id','=','ingreso_grifos.categoria_ingreso_id')
            ->join('grifos','grifos.id','=','ingreso_grifos.grifo_id')
            ->select( DB::raw('DAY(ingreso_grifos.fecha_ingreso) as day'),
                      DB::raw('sum(ingreso_grifos.monto_ingreso) as monto_ingreso'),
                'ingreso_grifos.fecha_ingreso','grifos.zona','categoria_ingresos.categoria'
            )            
            ->where('grifos.zona','NORTE')
            ->groupBy('day')
            ->get(); 
            $ingresos_grifos_SUR = CategoriaIngreso::join('ingreso_grifos','categoria_ingresos.id','=','ingreso_grifos.categoria_ingreso_id')
                ->join('grifos','grifos.id','=','ingreso_grifos.grifo_id')
                ->select( DB::raw('DAY(ingreso_grifos.fecha_ingreso) as day'),
                          DB::raw('sum(ingreso_grifos.monto_ingreso) as monto_ingreso'),
                    'ingreso_grifos.fecha_ingreso','grifos.zona','categoria_ingresos.categoria'
                )            
                ->where('grifos.zona','SUR')
                ->groupBy('day')
                ->get(); 
            $ingresos_grifos_ESTE = CategoriaIngreso::join('ingreso_grifos','categoria_ingresos.id','=','ingreso_grifos.categoria_ingreso_id')
                ->join('grifos','grifos.id','=','ingreso_grifos.grifo_id')
                ->select( DB::raw('DAY(ingreso_grifos.fecha_ingreso) as day'),
                          DB::raw('sum(ingreso_grifos.monto_ingreso) as monto_ingreso'),
                    'ingreso_grifos.fecha_ingreso', 'grifos.zona',
                    'categoria_ingresos.categoria'
                )            
                ->where('grifos.zona','ESTE')
                ->groupBy('day')
                ->get();            
        $collection = collect([$ingresos1, $ingresos2 ,
             $ingresos_grifos_NORTE , $ingresos_grifos_SUR,$ingresos_grifos_ESTE]);
        $collapsed = $collection->collapse();
        $ingresos =$collapsed->all(); 

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
     * Ingresos reporte por día.(grifos, venta cliente directo, otros)
     * @return [type] [description]
     */
    public function ingresosReporte(){

    }

    /**
     * [reporte de ingresos de un día,
     * al momento de registrar otros ingresos del mismo día]
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
