<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Proveedor;
use CorporacionPeru\Planta;
use CorporacionPeru\Http\Requests;
use CorporacionPeru\Http\Requests\StorePedidoRequest;
use Illuminate\Http\Request;
use CorporacionPeru\Pedido;
use CorporacionPeru\Cliente;
use CorporacionPeru\Grifo;
use CorporacionPeru\Vehiculo;
use CorporacionPeru\Transportista;
use CorporacionPeru\PedidoCliente;
use CorporacionPeru\PedidoProveedorCliente;
use CorporacionPeru\PedidoProveedorGrifo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use CorporacionPeru\Stock;
use Log;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Facades\Excel;
use CorporacionPeru\Exports\DistribucionExportView;

class PedidoController extends Controller
{

    
    public function reportePedidosCombustible($date=null, $idPedido=null): View
    {
        $pedidosDistribuidos = Pedido::where('galones_distribuidos','>',0)
                                ->get();
        $pedidos = [];
        if ( $idPedido == 0 ) {
            $pedidos = $pedidosDistribuidos->pluck('id'); 
        }else{
            $pedidos[] = $idPedido;
        }
        if ($date == -1) {//get sin fecha
            $pedidos = Pedido::with('pedidoProveedorClientes')
                ->with('pedidoProveedorGrifos')
                ->whereIn('id',$pedidos)
                ->get(); 
        }else{
            $pedidos = Pedido::with('pedidoProveedorClientes')
                ->with('pedidoProveedorGrifos')
                ->where('fecha_pedido',$date)
                ->whereIn('id',$pedidos)
                ->get();
        }

        $today_date = strftime( '%d/%m/%Y',strtotime('now') );
        return view('pedidosP.reporte_combustible.index',compact('today_date','pedidos','pedidosDistribuidos'));
    }

    public function exportView($date=null, $idPedido=null){

        return Excel::download(new DistribucionExportView($date , $idPedido),'PedidosCombustible.xlsx');
    }

    /**
     * Temporal| Pedidos con plantas, ver lista de pedidos
     * datatables servr side
     * @return [type] [description]
     */
    public function datatables_pedidos()
    {       
        return  datatables()
        ->eloquent(
            Pedido::leftJoin('factura_proveedors','factura_proveedors.id','=','pedidos.factura_proveedor_id')
            ->join('plantas','pedidos.planta_id','=','plantas.id')
            ->select(
                'pedidos.*','plantas.planta as planta','factura_proveedors.monto_factura',
                    DB::raw('ROUND(pedidos.costo_galon*pedidos.galones,2) as calc')
            )
            ->orderBy('id','DESC')
        )
        ->addColumn('state','actions.pedido.estado_dirigir')
        ->addColumn('actions','actions.pedido.acciones_dirigir')
        ->rawColumns(['state','actions'])
        ->toJson();
    }

    /**
     * Reporte Programacion diario.
     * @return [type] [description]
     */
    public function programacion(){
        $pedidos_cliente
                     = Pedido::leftJoin('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                    ->leftJoin('transportistas','transportistas.id','=','vehiculos.transportista_id')
                    ->join('pedido_proveedor_clientes','pedido_proveedor_clientes.pedido_id','=','pedidos.id')
                    ->join('pedido_clientes','pedido_clientes.id','=','pedido_proveedor_clientes.pedido_cliente_id')
                    ->join('clientes','clientes.id','=','pedido_clientes.cliente_id')
                    ->join('plantas','plantas.id','=','pedidos.planta_id')
                    ->select('pedido_clientes.fecha_descarga', 'clientes.razon_social',
                            'pedido_clientes.galones','pedido_clientes.horario_descarga',
                            'pedidos.scop','pedidos.nro_pedido','pedidos.id',
                            'plantas.planta',                             
                            'transportistas.nombre_transportista')
                    ->get();

        $pedidos_grifo = Pedido::leftJoin('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                    ->leftJoin('transportistas','transportistas.id','=','vehiculos.transportista_id')
                    ->join('plantas','plantas.id','=','pedidos.planta_id')
                    ->join('pedido_grifos','pedido_grifos.pedido_id','=','pedidos.id')
                    ->join('grifos','pedido_grifos.grifo_id','=','grifos.id')
                    ->select('grifos.razon_social','pedido_grifos.fecha_descarga', 
                            'pedido_grifos.asignacion as galones',                           
                            'pedidos.scop','pedidos.nro_pedido','pedidos.id',
                            'plantas.planta',  'transportistas.nombre_transportista')
                    ->get();  
        $collection = collect([$pedidos_grifo, $pedidos_cliente]);
        $collapsed = $collection->collapse();
        $pedidos =$collapsed->all();
       
        return view('programacion.index',compact('pedidos'));
    }
    /**
     * confirmación Pedido
     * @param  [type] $id [id del pedido]
     * @return [type]     [description]
     */
    public function confirmarPedido($id)
    {
        $pedido = Pedido::findOrFail($id);
        /*Logica para actualizar pedido pendiente*/
        $pedido->estado = 2;
        $pedido->save();
        return  back()->with('alert-type', 'success')->with('status', 'Pedido confirmado con exito');
    }

    /**
     *  Deshace Distribución
     * @param  [type] $id [id del pedido]
     * @return [type]     [description]
     */
    public function reverse($id)
    {
        DB::beginTransaction();
        try {
            $pedido = Pedido::findOrFail($id);
            //Sí el transportista ha sido pagado no se puede eliminar la distribución.
            if ( $pedido->estado_flete == 2 ) {
                return  back()->with('alert-type', 'error')->with('status', 'No se puede deshacer un pedido que ya ha sido pagado al transportista.');
            }
            $pedido_proveedor_clientes = PedidoProveedorCliente::where('pedido_id',$id)->get();
            $pedido_proveedor_grifos   = PedidoProveedorGrifo::where('pedido_id',$id)->get();
            
            //grifos
            foreach ($pedido_proveedor_grifos as $pivote_grifos) {
                $asignacion = $pivote_grifos->asignacion;
                $id_grifo = $pivote_grifos->grifo_id;
                $grifo = Grifo::findOrFail($id_grifo);
                $grifo->stock -= $asignacion;
                $grifo->save();
                PedidoProveedorGrifo::findOrFail($pivote_grifos->id)->delete();
            }
            //pedido clientes
            foreach ($pedido_proveedor_clientes as $pivote_clientes) {
                $asignacion        = $pivote_clientes->asignacion;
                $pedido_cliente_id = $pivote_clientes->pedido_cliente_id;
                $pedido_cliente    = PedidoCliente::findOrFail($pedido_cliente_id);

                if ( $pedido_cliente->estado == 3 ) {// ha sido distribuido
                    $pedido_cliente->estado = 2;
                }
                $pedido_cliente->galones_asignados-=$asignacion;            
                $pedido_cliente->save();
                PedidoProveedorCliente::findOrFail($pivote_clientes->id)->delete();
            } 
            //pedido proveedor
            if ($pedido->estado == 3) {//distribuido
                $pedido->estado = 2;
            }            
            $pedido->galones_distribuidos = 0;
            $pedido->costo_flete = null;
            $pedido->chofer = null;
            $pedido->brevete_chofer = null;
            $pedido->vehiculo_id = null;
            $pedido->save();
        DB::commit();
        return  back()->with('alert-type', 'success')->with('status', 'Distribución eliminada con éxito'); 

        } catch (\Exception  $e) {          
            DB::rollback();
            return  back()->with('alert-type', 'error')->with('status', 'Ocurrió un error en el servidor.');
        } 

    }

    /**
     * [Obtener 1 pedido, a partir del id_proveedor]
     * @param  [int] $id_proveedor [description]
     * @return [response] [pedido en json]
     */
    public function show2($id_proveedor)
    {
        $planta = Planta::findOrFail($id_proveedor);
        $id = $planta->id;
        $pedido = Pedido::where('planta_id', $id)->first();


        return response()->json(['pedido' => $pedido]);
    }

    /**
     * Muestra todos los pedidos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plantas = Planta::all();
        $pedidos = Pedido::leftJoin('factura_proveedors','factura_proveedors.id','=','pedidos.factura_proveedor_id')
            ->join('plantas','pedidos.planta_id','=','plantas.id')
            ->select(
                'pedidos.*','plantas.planta as planta','factura_proveedors.monto_factura as monto_factura', 'factura_proveedors.fecha_factura_proveedor',
                    DB::raw('ROUND(pedidos.costo_galon*pedidos.galones,2) as calc'),
                    'factura_proveedors.nro_factura_proveedor'
            )
            ->orderBy('fecha_pedido','DESC')
            ->get();
        $stock = Stock::first();
        return view('pedidosP.index',compact('pedidos','plantas','stock'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plantas = Planta::all();
        return view('pedidosP.create_pedido.index', compact('plantas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function store(StorePedidoRequest $request)
    {
        DB::beginTransaction();
        try {
            $pedido=Pedido::create( $request->validated() );
            $pedido->saldo = $pedido->getMonto();
            $pedido->save();
            $stock = Stock::first();
            $stock->stock_general += $pedido->galones;
            $stock->save();
            DB::commit();

            $planta =  $pedido->planta ;
            $proveedor = $planta->proveedor;
            $deuda_proveedor = Proveedor::
                leftJoin('plantas','plantas.proveedor_id','=','proveedores.id')
                ->leftJoin('pedidos','pedidos.planta_id','=','plantas.id') 
                ->where('proveedores.id','=',$proveedor->proveedor_id)        
                ->select( DB::raw('sum(pedidos.saldo) as deuda_total') )
                ->first(); 
        //deuda total (solo facturados) + monto potencial a ser deuda(pedido actual)
            $monto_pedido_actual = $pedido->getMonto();
            $deuda_total_nueva = $deuda_proveedor->deuda_total +  $monto_pedido_actual; 

            if ($deuda_total_nueva >= $proveedor->linea_credito) {
                return  redirect()->action('PedidoController@index')
                    ->with(['alert-type' => 'info', 'status' => 'Si se factura el nuevo pedido excederá su línea de crédito. Pedido Registrado']);
            }

            return  redirect()->action('PedidoController@index')->with('alert-type', 'success')->with('status', 'Pedido creado con exito');

        } catch (Exception $e) {          
            DB::rollback();
            return  back()->with('alert-type', 'error')->with('status', 'Ocurrió un error en el servidor.');
        } 


    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $transportista = "FLETE PROPIO";
        $id_t          = 1; 
        $pedido        = Pedido::where('id','=',$id)->with('planta')->with('vehiculo')->with('facturaProveedor')->first();
        $planta = Planta::findOrFail( $pedido->planta->id );
        $id_proveedor = $planta->proveedor_id;
        $proveedor     = Proveedor::findOrFail( $id_proveedor );
        if ( $pedido->vehiculo_id != null ) {
        $transportista_id = $pedido->vehiculo->transportista_id;
        $transportistaCol = Transportista::findOrFail($transportista_id);     
        $transportista    = $transportistaCol->nombre_transportista;
        $id_t             = $transportistaCol->id;
        }       
        return view( 'facturas.show.index',compact(  'pedido' , 'transportista','id_t','proveedor' ) );
     
    }

    /**
     * Muestra interfaz para la distribución a  grifos.   
     * @param  \CorporacionPeru\Pedido  $pedido
     * @return \Illuminate\Http\Response pedido and grifos
     */

    public function distribuir_grifo($id){
        $pedido = Pedido::where('id','=',$id)->with('planta')->first();
        $grifos = Grifo::all();
        return view('distribucion.grifos.index',compact( 'pedido' , 'grifos'));
    }

    /**
     * Muestra interfaz para  distribuir a pedido cliente.
     *
     * @param  \CorporacionPeru\Pedido  $id
     * @return \Illuminate\Http\Response
     */

    public function distribuir($id)
    {
        $pedido = Pedido::where('id', '=', $id)->with('planta')->first();
        $pedidos_clientes_confirmados
                    = PedidoCliente::where('estado', '=', 2)->with('cliente')->orderBy('id', 'desc')->get();
        $pedidos_cl = $pedidos_clientes_confirmados;
        $vehiculos  = Vehiculo::all();
        $vehiculo_asignado = null;
        if ( $pedido->vehiculo_id != null) {
            $id_vehiculo = $pedido->vehiculo_id;
            $vehiculo_asignado = Vehiculo::findOrFail( $id_vehiculo )->with('transportista')->first();
        }
        return view('distribucion.index', compact('pedido', 'pedidos_cl', 
                                                    'vehiculos','vehiculo_asignado'));
    }

        /**
     * Muestra resumen de la distribución
     *
     * @param  \CorporacionPeru\Pedido  $id
     * @return \Illuminate\Http\Response
     */

    public function ver_distribucion($id)
    {

        $pedido = Pedido::findOrFail($id);
        $pedidos_cl = PedidoCliente::join('pedido_proveedor_clientes', 'pedido_clientes.id', '=', 'pedido_proveedor_clientes.pedido_cliente_id')
            ->select('pedido_clientes.*','pedido_proveedor_clientes.asignacion')
            ->where('pedido_id', $id)->get();
         $pedidos_grifos = Grifo::join('pedido_grifos','grifos.id','=', 'pedido_grifos.grifo_id')          
            ->where('pedido_id', $pedido->id)
            ->get();        
        return view('distribucion.resumen.index', compact('pedido','pedidos_cl','pedidos_grifos'));
    }
    /**
     * Se agrega una cantidad de galones de un pedido
     * al stock de un grifo.
     * @param  Request $request [id_grifo, id_pedido_pr, galones_X_asignar]
     * @return [view]           [back|resumen distribucion]
     */
    public function asignar_grifo(Request $request)
    {       

        $fecha_descarga = $request->fecha_descarga; 
        $hora_descarga = $request->hora_descarga;     
        $grifo = Grifo::findOrFail($request->id_grifo);
        $asignacion = $request->galones_x_asignar;
        $pedido = Pedido::findOrFail($request->id_pedido_pr);
        $galonaje_stock = $pedido->getGalonesStock();
            // 200       <         300
        if ( $galonaje_stock < $asignacion or $asignacion <= 0 ) {
            return back()->with('alert-type', 'error')->with('status', 'Galonaje incorrecto!');
        }

        DB::beginTransaction();
        try {
            
            if ( $galonaje_stock == $asignacion ) {
                $grifo->stock += $asignacion;
                $pedido->galones_distribuidos += $asignacion;
                if ($pedido->estado < 4) {
                    $pedido->estado = 3;
                }
                $pedido->grifos()->attach($grifo->id,['asignacion'=> $asignacion,'fecha_descarga'=> $fecha_descarga , 'hora_descarga'=> $hora_descarga ]);
                $pedido->save();
                $grifo->save();
                Session::flash('alert-type', 'info');
                Session::flash('status', 'Galones asignados a Grifo');
                DB::commit();
            return  redirect()->action('PedidoController@ver_distribucion',$pedido->id);
;
            }
            else //( $galonaje_stock < $asignacion  )
             { 
                $grifo->stock += $asignacion;
                $pedido->galones_distribuidos += $asignacion;
                $pedido->grifos()->attach($grifo->id,['asignacion'=> $asignacion,'fecha_descarga'=> $fecha_descarga  , 'hora_descarga'=> $hora_descarga]);
                $pedido->save();
                $grifo->save();
                DB::commit();
                return back()->with('alert-type', 'success')->with('status', 'Galones asignados a Grifo');
            }


        } catch (Exception $e) {          
            DB::rollback();
            return  back()->with('alert-type', 'error')->with('status', 'Ocurrió un error en el servidor.');
        } 

    }


    public function asignar_individual(Request $request)
    {
        //START TRANSACTION
        $pedido_cl = PedidoCliente::findOrFail($request->id_pedido_cliente);
        $pedido = Pedido::findOrFail($request->id_pedido_pr);
        $galonaje_stock = $pedido->getGalonesStock();

        if (
            $pedido->getGalonesStock() <= 0 or
            $pedido_cl->galonesXasignar() <= 0
        ) {

            return back()->with('alert-type', 'error')->with('status', 'Galonaje incorrecto!');
        }
        $restanteXasignar = $pedido_cl->galonesXasignar();
        DB::beginTransaction();
        try {
           if ($restanteXasignar > $galonaje_stock) {

            $pedido_cl->galones_asignados += $galonaje_stock;
            $pedido->galones_distribuidos += $galonaje_stock;
            $asignacion = $galonaje_stock;
            $pedido->pedidosCliente()->attach($pedido_cl->id,['asignacion'=> $asignacion]);
            if ($pedido->estado < 4) {
                $pedido->estado = 3;
                }
            $stock = Stock::first();
            $stock->stock_general -= $asignacion;
            $stock->save();  
            $pedido->save();
            $pedido_cl->save();   

        } elseif( $restanteXasignar == $galonaje_stock ) { //si el stock es igual a lo q se distribuira

            $pedido_cl->galones_asignados += $restanteXasignar;
            $pedido->galones_distribuidos += $restanteXasignar;
            $pedido_cl->estado = 3;
            if ($pedido->estado < 4) {
                $pedido->estado = 3;
                }
            $asignacion = $restanteXasignar;
            $pedido->pedidosCliente()->attach($pedido_cl->id,['asignacion'=> $asignacion]);
            $stock = Stock::first();
            $stock->stock_general -= $asignacion;
            $stock->save();
            $pedido->save();
            $pedido_cl->save();      

        } else{//si el stock es mayor a lo q se distribuira

            $pedido_cl->galones_asignados += $restanteXasignar;
            $pedido->galones_distribuidos += $restanteXasignar;
            $pedido_cl->estado = 3;
            $asignacion = $restanteXasignar;
            $pedido->pedidosCliente()->attach($pedido_cl->id,['asignacion'=> $asignacion]);
            $stock = Stock::first();
            $stock->stock_general -= $asignacion;
            $stock->save();
            $pedido->save();
            $pedido_cl->save();  

        }
        DB::commit();
        Session::flash('alert-type', 'info');
        Session::flash('status', 'Galones asignados a Pedido de Cliente');
        return  redirect()->action('PedidoController@ver_distribucion',$pedido->id);
        } catch (Exception $e) {          
            DB::rollback();
            return  back()->with('alert-type', 'error')->with('status', 'Ocurrió un error en el servidor.');
        } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pedido = Pedido::find($id);
        $vehiculos = Vehiculo::all();

        return view('facturas.Ind.index', compact('pedido', 'vehiculos'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(StorePedidoRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $id = $request->id;
            $pedido_anterior=Pedido::findOrFail($id);
            $gls_anterior = $pedido_anterior->galones;
            $pedido=Pedido::findOrFail($id);
            Pedido::findOrFail($id)->update($request->validated());
            $gls_nuevo = $pedido->galones; 
            $pedido->saldo = round($request->costo_galon*$request->galones,2);//new saldo
            $pedido->save();
            $stock = Stock::first();       
            $stock->stock_general -= $gls_anterior;
            $stock->stock_general += $gls_nuevo;
            $stock->save();  
            DB::commit();
            return  back()->with('alert-type', 'success')->with('status', 'Pedido editado con exito');
        } catch (Exception $e) {          
            DB::rollback();
            return  back()->with('alert-type', 'error')->with('status', 'Ocurrió un error en el servidor.');
        }     

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $pedido = Pedido::findOrFail($id);
            Pedido::destroy($id);
            $stock = Stock::first();
            $stock->stock_general -= $pedido->galones;
            $stock->save();
            DB::commit();
            return  back()->with('alert-type', 'warning')->with('status', 'Pedido borrado con exito');
        } catch (Exception $e) {          
            DB::rollback();
            return  back()->with('alert-type', 'error')->with('status', 'Ocurrió un error en el servidor.');
        }        
        
    }
}
