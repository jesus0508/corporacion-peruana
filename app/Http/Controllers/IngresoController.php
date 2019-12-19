<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Ingreso;
use Illuminate\Http\Request;
use CorporacionPeru\Categoria;
use CorporacionPeru\Egreso;
use CorporacionPeru\IngresoGrifo;
use CorporacionPeru\CategoriaIngreso;
use CorporacionPeru\MovimientoGrifo;
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
            ->select('ingresos.*','categoria_ingresos.categoria','ingresos.created_at as esIngreso')
            ->get();

        $ingresos2 = CategoriaIngreso::join('pago_clientes','categoria_ingresos.id','=','pago_clientes.categoria_ingreso_id')
            ->join('pago_cliente_pedido_cliente','pago_cliente_pedido_cliente.pago_cliente_id','=','pago_clientes.id')
            ->join('pedido_clientes','pedido_clientes.id','=','pago_cliente_pedido_cliente.pedido_cliente_id')
            ->join('clientes','clientes.id','=','pedido_clientes.cliente_id')
        //more joins to get the rzon_social del cliente
            ->select('pago_clientes.codigo_operacion', 'clientes.razon_social' ,'pago_clientes.monto_operacion as monto_ingreso','pago_clientes.banco','pago_clientes.fecha_operacion as fecha_ingreso','categoria_ingresos.categoria')
            ->groupBy('pago_clientes.codigo_operacion')
            ->get(); 
        $ingresos3 = CategoriaIngreso::join('movimientos','categoria_ingresos.id','=','movimientos.categoria_ingreso_id')
            ->where('movimientos.estado','!=',3)
            ->select('movimientos.codigo_operacion','movimientos.monto_operacion as monto_ingreso','movimientos.banco','movimientos.fecha_operacion as fecha_ingreso','categoria_ingresos.categoria','categoria_ingresos.id as id_cat')
            ->get();  
                //Ingresos movimientos grifo -- ingreso extraordinario
        $ingresos4 = MovimientoGrifo::where('estado','!=',3)
            ->select('id as esGrifo', 'codigo_operacion',
                'monto_operacion as monto_ingreso',
                'fecha_operacion as fecha_ingreso')
            ->get();

            //PARA OBTENER LOS INGRESOS NETOS DE GRIFOS X ZONA
            //agregar egreso de monto 0 con estado, visible1 e invisible0 
            //para mostrar en neto
        $egresos_zona_grifo = Egreso::join('concepto_gastos','concepto_gastos.id','=','egresos.concepto_gasto_id')
                    ->join('sub_categoria_gastos','sub_categoria_gastos.id','=','concepto_gastos.sub_categoria_gasto_id')
                    ->join('categoria_gastos','categoria_gastos.id','=','sub_categoria_gastos.categoria_gasto_id')
                    ->join('grifos','grifos.id','=','egresos.grifo_id')
                    ->select(DB::raw('DATE(fecha_egreso) as day'), 'grifos.zona',
                        DB::raw('-1*(sum(monto_egreso)) as monto'),'egresos.grifo_id'
                            )//estado 0
                    ->groupBy('grifos.zona' ,'day')
                    ->get();

        $ingresos_zona_grifo = IngresoGrifo::join('grifos','grifos.id','=','ingreso_grifos.grifo_id')
                    ->join('categoria_ingresos','categoria_ingresos.id','=','ingreso_grifos.categoria_ingreso_id')
                    ->select('ingreso_grifos.fecha_reporte',
                        'ingreso_grifos.fecha_ingreso as day','grifos.zona',
                     DB::raw('sum(monto_ingreso) as monto') , 'categoria_ingresos.categoria' ,'ingreso_grifos.grifo_id')
                    ->groupBy('day','grifos.zona')
                    ->get();

        $ingreso_grifos_zonas = collect([]); 
        foreach ($ingresos_zona_grifo as $ingreso) {
            foreach ($egresos_zona_grifo as $egreso ) {
                if( $ingreso->day == $egreso->day AND $ingreso->zona==$egreso->zona){
                        $consolidado = $egreso->monto + $ingreso->monto;
                        $consolidado = round( $consolidado, 2 );
                        $neto =[    'fecha_reporte'   => $ingreso->fecha_reporte, 
                                    'fecha_ingreso'   => $ingreso->day, 
                                    'zona' => $egreso->zona,
                                    'categoria' => $ingreso->categoria,
                                    'monto_ingreso' => $consolidado ];    
                        $neto = (object)$neto;                  
                        $ingreso_grifos_zonas->push($neto);
                    }
                }                
            } 
           // return $ingreso_grifos_zonas; 
        $collection = collect([$ingresos1, $ingresos2 , $ingresos3 , $ingresos4,
             $ingreso_grifos_zonas]);
        $collapsed = $collection->collapse();
        $ingresos =$collapsed->all(); 
        //return $ingresos2;
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
    public function update(Request $request,  $id)
    {
       // return $request;
        $id = $request->id;       
        Ingreso::findOrFail($id)->update($request->all());
        return 
        back()->with('alert-type','success')->with('status','Ingreso actualizado con exito');  
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
