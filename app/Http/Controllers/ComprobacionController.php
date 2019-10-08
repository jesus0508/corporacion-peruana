<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Comprobacion;
use Illuminate\Http\Request;
use CorporacionPeru\Ingreso;
use CorporacionPeru\CategoriaIngreso;
use CorporacionPeru\Deposito;
use DB;
use Carbon\Carbon;

class ComprobacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //ingresos EFECTIVO
        $ingresos1 = Ingreso::join('categoria_ingresos','categoria_ingresos.id','=','ingresos.categoria_ingreso_id')
            ->whereNull('ingresos.codigo_operacion')
            ->select('ingresos.*','categoria_ingresos.categoria')
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
        $collection = collect([$ingresos1, $ingresos_grifos_NORTE ,
        $ingresos_grifos_SUR,$ingresos_grifos_ESTE]);
        $collapsed = $collection->collapse();
        $ingresos =$collapsed->all(); 

        //DEPOSITOS GRIFO DEL DÍA
        $depositos = Deposito::join('cuentas','cuentas.id','=','depositos.cuenta_id')
            ->join('bancos','bancos.id','=','cuentas.banco_id')
            ->select('depositos.*','bancos.abreviacion','bancos.banco','cuentas.nro_cuenta')
            ->get();

        //COMPROBACIONES
        $comprobaciones =  Comprobacion::all();

        return view('comprobacion.diario.index', compact('ingresos','depositos','comprobaciones'));
    }

       /**
     * [reporte de comprobaciones de un día,
     * al momento de registrar otros comprobaciones del mismo día]
     * @return [type] [description]
     */
    public function comprobacionesDT( $date = null ){
        if ( $date == null ) {
          $date = Carbon::now()->format('Y-m-d');
        }             
        return datatables()
            ->eloquent( Comprobacion::query()
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
        
        //ingresos EFECTIVO
        $ingresos1 = Ingreso::join('categoria_ingresos','categoria_ingresos.id','=','ingresos.categoria_ingreso_id')
            ->whereNull('ingresos.codigo_operacion')
            ->select('ingresos.*','categoria_ingresos.categoria')
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
        $collection = collect([$ingresos1, $ingresos_grifos_NORTE ,
         $ingresos_grifos_SUR,$ingresos_grifos_ESTE]);
        $collapsed = $collection->collapse();
        $ingresos =$collapsed->all(); 

        //DEPOSITOS GRIFO DEL DÍA
        $depositos = Deposito::join('cuentas','cuentas.id','=','depositos.cuenta_id')
            ->join('bancos','bancos.id','=','cuentas.banco_id')
            ->select('depositos.*','bancos.abreviacion','bancos.banco','cuentas.nro_cuenta')
            ->get();

        return view('comprobacion.create.index', compact('ingresos','depositos'));
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

                // $fecha_reporte = new Carbon;           
                // $fecha_reporte = $request->fecha_reporte;
                // $fecha_reporte = $fecha_reporte->toDateString();
                //Carbon::parse($request->fecha_reporte)->format('Y-m-d');
            //$fecha_reporte=    Carbon::createFromFormat('Y-m-d', $request->fecha_reporte);
            $date = new Carbon($request->fecha_reporte);
                Comprobacion::create([
                    'detalle'=> $request->detalle  ,    
                    'fecha'=> $request->fecha  ,
                    'fecha_reporte'=>$date  ,
                    'monto'=> $request->monto
                             
                ]);
                return response()->json([
                    'mensaje' => 'creado'
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Comprobacion  $comprobacion
     * @return \Illuminate\Http\Response
     */
    public function show(Comprobacion $comprobacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\Comprobacion  $comprobacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Comprobacion $comprobacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Comprobacion  $comprobacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comprobacion $comprobacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\Comprobacion  $comprobacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comprobacion $comprobacion)
    {
        //
    }
}
