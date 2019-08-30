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
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{

    public function confirmarPedido($id)
    {
        $pedido = Pedido::findOrFail($id);
        /*Logica para actualizar pedido pendiente*/
        $pedido->estado = 2;
        $pedido->save();
        return  back()->with('alert-type', 'success')->with('status', 'Pedido confirmado con exito');
    }

    public function show2($id_proveedor)
    {
        $planta = Planta::findOrFail($id_proveedor);
        $id = $planta->id;
        $pedido = Pedido::where('planta_id', $id)->first();


        return response()->json(['pedido' => $pedido]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pedidos = Pedido::with('planta')->with('facturaProveedor')->orderBy('id','desc')->get();
        $plantas = Planta::all();
        return view('pedidosP.index', compact('pedidos', 'plantas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$pedido=Pedido::all();
        $plantas = Planta::all();


        return view('pedidosP.create_pedido.index', compact('plantas'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePedidoRequest $request)
    {
        //
        Pedido::create($request->validated());
        return  redirect()->action('PedidoController@index')->with('alert-type', 'success')->with('status', 'Pedido creado con exito');
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
        //return$pedido;
        return view( 'facturas.show.index',compact(  'pedido' , 'transportista','id_t','proveedor' ) );
     
    }

        /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */

    public function distribuir_grifo($id){
        $pedido = Pedido::where('id','=',$id)->with('planta')->first();

        //$pedidos_cl = Cliente::where('tipo',1)->get();
        $grifos = Grifo::all();

       // return $pedidos_cl;
        return view('distribucion.grifos.index',compact( 'pedido' , 'grifos'));


    }

    /**
     * Muestra interfaz para  distribuir
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
        //return $pedidos_cl;
        //return $vehiculo_asignado;
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
        $pedidos_cl = PedidoCliente::join('pedido_proveedor_clientes', 'pedido_clientes.id', '=', 'pedido_proveedor_clientes.pedido_cliente_id')->where('pedido_id', $id)->get();
        
         $pedidos_grifos = Grifo::join('pedido_grifos','grifos.id','=', 'pedido_grifos.grifo_id')
           // ->join('pedidos','pedidos.id','=','pedido_grifos.pedido_id')
            ->where('pedido_id', $pedido->id)
            //->groupBy('grifos.id')
            //->select('grifos.razon_social',grifos)
            ->get();

        return view('distribucion.resumen.index', compact('pedido', 'pedidos_cl','pedidos_grifos'));
    }
    /**
     * Se agrega una cantidad de galones de un pedido
     * al stock de un grifo.
     * @param  Request $request [id_grifo, id_pedido_pr, galones_X_asignar]
     * @return [view]           [back|resumen distribucion]
     */
    public function asignar_grifo(Request $request)
    {

        $grifo = Grifo::findOrFail($request->id_grifo);
        $asignacion = $request->galones_x_asignar;
        $pedido = Pedido::findOrFail($request->id_pedido_pr);
        $galonaje_stock = $pedido->getGalonesStock();
            // 200       <         300
        if ( $galonaje_stock < $asignacion or $asignacion <= 0 ) {

            return back()->with('alert-type', 'error')->with('status', 'Galonaje incorrecto!');
        }
         
        if ( $galonaje_stock == $asignacion ) {

            $grifo->stock += $asignacion;
            $pedido->galones_distribuidos += $asignacion;
            $pedido->estado = 3;
            $pedido->grifos()->attach($grifo->id,['asignacion'=> $asignacion]);
            $pedido->save();
            $grifo->save();

            $pedidos_cl = 
                PedidoCliente::join('pedido_proveedor_clientes', 
                    'pedido_clientes.id', '=', 'pedido_proveedor_clientes.pedido_cliente_id')
                ->join('pedidos', 'pedidos.id', '=', 'pedido_proveedor_clientes.pedido_id')
                ->where('pedido_id', $request->id_pedido_pr)->get();

            $pedidos_grifos = Grifo::join('pedido_grifos','grifos.id','=', 'pedido_grifos.grifo_id')
                ->join('pedidos','pedidos.id','=','pedido_grifos.pedido_id')
                ->where('pedido_id', $pedido->id)
                //->groupBy('grifos.id')
                ->get();

        return view('distribucion.resumen.index', compact('pedido', 'pedidos_cl','pedidos_grifos'))->with('alert-type', 'success')->with('status', 'Galones asignados a Grifo');
           }   

        else //( $galonaje_stock < $asignacion  )
         { 

            $grifo->stock += $asignacion;
            $pedido->galones_distribuidos += $asignacion;
            $pedido->grifos()->attach($grifo->id,['asignacion'=> $asignacion]);
            $pedido->save();
            $grifo->save();

            return back()->with('alert-type', 'success')->with('status', 'Galones asignados a Grifo');
        }


    }


    public function asignar_individual(Request $request)
    {

        $pedido_cl = PedidoCliente::findOrFail($request->id_pedido_cliente);
       // $cantDistribuir = $request->galonesXasignar;
        $pedido = Pedido::findOrFail($request->id_pedido_pr);
        $galonaje_stock = $pedido->getGalonesStock();

        if (
            $pedido->getGalonesStock() <= 0 or
            $pedido_cl->galonesXasignar() <= 0
        ) {

            return back()->with('alert-type', 'error')->with('status', 'Galonaje incorrecto!');
        }

        $restanteXasignar = $pedido_cl->galonesXasignar();
        //$request->galones_pedido_cl;

        if ($restanteXasignar > $galonaje_stock) {

            $pedido_cl->galones_asignados += $galonaje_stock;
            $pedido->galones_distribuidos += $galonaje_stock;
            $pedido->pedidosCliente()->attach($pedido_cl->id);
            $pedido->estado = 3;
            $pedido->save();
            $pedido_cl->save();   

        } elseif( $restanteXasignar == $galonaje_stock ) { //si el stock es igual a lo q se distribuira

            $pedido_cl->galones_asignados += $restanteXasignar;
            $pedido->galones_distribuidos += $restanteXasignar;
            $pedido_cl->estado = 3;
            $pedido->estado = 3;
            $pedido->pedidosCliente()->attach($pedido_cl->id);
            $pedido->save();
            $pedido_cl->save();      

        } else{//si el stock es mayor a lo q se distribuira

            $pedido_cl->galones_asignados += $restanteXasignar;
            $pedido->galones_distribuidos += $restanteXasignar;
            $pedido_cl->estado = 3;
            $pedido->pedidosCliente()->attach($pedido_cl->id);
            $pedido->save();
            $pedido_cl->save();  

        }
                   // return back()->with('alert-type', 'success')->with('status', 'Galones asignados a Pedido');
        $pedidos_cl = PedidoCliente::join('pedido_proveedor_clientes', 'pedido_clientes.id', '=', 'pedido_proveedor_clientes.pedido_cliente_id')->where('pedido_id', $request->id_pedido_pr)->get();

            return view('distribucion.resumen.index', compact('pedido', 'pedidos_cl'));
   


        
    }




    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */

    public function distribuir_pedido(Request $request){

    try {

        DB::beginTransaction();

        $cantDistribuir = $request->galones_dist;
        $pedido = Pedido::findOrFail($request->pedido_id);
       //    $contador = 1;

        $pedidos_cl = PedidoCliente::where('estado','=',2)->with('cliente')->orderBy('galones_asignados','asc')->get();
        $galonaje_stock = $cantDistribuir;
       // return $pedidos_cl;
        foreach ($pedidos_cl as $pedido_cl) {
                            // 1500 - 1500
            $restanteXasignar = $pedido_cl->galones - $pedido_cl->galones_asignados;
            if(  $pedido->getGalonesStock() <= 0 or 
                  $galonaje_stock == 0){

                break; //sale del foreach

            }
            //galonaje en stock <= galonaje x asignar
            //  1500                     1500
           if( $restanteXasignar > $galonaje_stock ){

                $cantAsignada = $pedido_cl->galones_asignados + $galonaje_stock;
                if ( $cantAsignada <= $pedido_cl->galones ) {

                    $pedido_cl->galones_asignados = $cantAsignada;
                    $pedido->galones_distribuidos += $galonaje_stock; 
                    $galonaje_stock = 0;
                    $pedido->estado = 3; 
                    //se le asigna el pedido proveedor al pedido cliente
                    $pedido->pedidosCliente()->attach($pedido_cl->id);
                    // $pedido_cl->pedidos()->attach($pedido_cl->id);
                    $pedido->save();                    
                    $pedido_cl->save();
                    break;                
                }             
                
           } else{//si el stock es mayor a lo q se distribuira
                //  1500 = 1500 
                $cantAsignada = $pedido_cl->galones - $pedido_cl->galones_asignados ;

                if( $cantAsignada <= $pedido_cl->galones ){

                    $pedido_cl->galones_asignados += $cantAsignada;
                    $galonaje_stock -= $cantAsignada;
                    $pedido->galones_distribuidos += $cantAsignada;
                    $pedido_cl->estado = 3;
                    $pedido->estado = 3;
                    // se le asigna el pedido proveedor al pedido cliente
                    // $pedido_cl->pedidos()->attach($pedido_cl->id);
                    $pedido->pedidosCliente()->attach($pedido_cl->id);
                    $pedido->save();
                    $pedido_cl->save();
                }
           }          

        }//FIN FOREACH
         DB::commit();

        $pedidos_cl = PedidoCliente::join('pedido_proveedor_clientes', 'pedido_clientes.id', '=', 'pedido_proveedor_clientes.pedido_cliente_id')->join('pedidos', 'pedidos.id', '=', 'pedido_proveedor_clientes.pedido_id')->where('pedido_id',$request->pedido_id)->get();
       // $pedidos_cl =  $pedidos_cl->pedidos->wherePivot('pedido_id','=',$request->pedido_id)->get();
       // $pedidos_cl->where('pivot.pedido_id','=',1);
       //return $pedidos_cl;
        return view('distribucion.resumen.index',compact( 'pedido' , 'pedidos_cl' ));
    } //fin try
        catch (Exception $e) {

            $pedido = Pedido::where('id', '=', $id)->with('planta')->first();

            $pedidos_clientes_confirmados
                = PedidoCliente::where('estado', '=', 2)->with('cliente')->orderBy('galones_asignados', 'asc')->get();
            $pedidos_cl = $pedidos_clientes_confirmados;

            DB::rollback();

            return view('distribucion.index', compact('pedido', 'pedidos_cl'))->with('alert-type', 'error')->with('status', 'Ocurrio un error inesperado!');
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
        $id = $request->id;
        // return $request;
        Pedido::findOrFail($id)->update($request->validated());

        return  back()->with('alert-type', 'success')->with('status', 'Pedido editado con exito');
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Pedido::destroy($id);


        return  back()->with('alert-type', 'warning')->with('status', 'Pedido borrado con exito');
    }
}
