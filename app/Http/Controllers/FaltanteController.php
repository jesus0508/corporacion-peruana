<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Faltante;
use Illuminate\Http\Request;
use CorporacionPeru\Pedido;
use CorporacionPeru\Vehiculo;
use CorporacionPeru\Transportista;
use CorporacionPeru\PedidoProveedorGrifo;
use CorporacionPeru\PedidoProveedorCliente;
use CorporacionPeru\PagoTransportista;
use Carbon\Carbon;
class FaltanteController extends Controller
{
    /**
     *  Mostrar lista de faltantes, incluye.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos_cliente
                     = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                    ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
                    ->join('pedido_proveedor_clientes','pedido_proveedor_clientes.pedido_id','=','pedidos.id')
                    ->join('pedido_clientes','pedido_clientes.id','=','pedido_proveedor_clientes.pedido_cliente_id')
                    ->join('clientes','clientes.id','=','pedido_clientes.cliente_id')
                    ->join('plantas','plantas.id','=','pedidos.planta_id')
                    ->whereNotNull('pedidos.vehiculo_id')
                    ->whereNotNull('pedido_proveedor_clientes.faltante')
                    //->where('pedidos.estado_flete',2)
                    ->select('pedido_clientes.fecha_descarga', 'clientes.razon_social',
                            'pedido_clientes.galones','pedido_clientes.horario_descarga',
                            'pedidos.scop','pedidos.nro_pedido','pedidos.id',
                            'plantas.planta', 'pedidos.estado_flete',
                            'transportistas.nombre_transportista','pedido_clientes.observacion',
                            'pedido_proveedor_clientes.precio_galon_faltante as costo_galon',
                            'pedido_proveedor_clientes.faltante',
                            'pedido_proveedor_clientes.grifero',
                            'pedido_proveedor_clientes.descripcion')
                    ->get();

        $pedidos_grifo = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                    ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
                    ->join('plantas','plantas.id','=','pedidos.planta_id')
                    ->join('pedido_grifos','pedido_grifos.pedido_id','=','pedidos.id')
                    ->join('grifos','pedido_grifos.grifo_id','=','grifos.id')                    
                    ->whereNotNull('pedidos.vehiculo_id')
                    ->whereNotNull('pedido_grifos.faltante')
                    //->where('pedidos.estado_flete',2)
                    ->select('grifos.razon_social',
                            'pedido_grifos.asignacion as galones',
                            'pedido_grifos.precio_galon_faltante as costo_galon',                            
                            'pedidos.scop','pedidos.nro_pedido','pedidos.id',
                            'plantas.planta', 'pedidos.estado_flete',
                            'transportistas.nombre_transportista',
                            'pedido_grifos.faltante',
                            'pedido_grifos.grifero',
                            'pedido_grifos.descripcion','pedido_grifos.fecha_descarga')
                    ->get();
        
        $collection = collect([$pedidos_grifo, $pedidos_cliente]);
        $collapsed = $collection->collapse();
        $pedidos =$collapsed->all(); 
       return view('transportistas.lista_faltantes.index',compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        $pedidos_cliente
                     = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                    ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
                    ->join('pedido_proveedor_clientes','pedido_proveedor_clientes.pedido_id','=','pedidos.id')
                    ->join('pedido_clientes','pedido_clientes.id','=','pedido_proveedor_clientes.pedido_cliente_id')
                    ->whereNotNull('pedidos.vehiculo_id')
                    ->where('pedidos.estado_flete','=',1)
                    ->select('transportistas.nombre_transportista','transportistas.id')
                    ->groupBy('transportistas.id')
                    ->get();

        $pedidos_grifo = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                    ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
                    ->join('pedido_grifos','pedido_grifos.pedido_id','=','pedidos.id')             
                    ->whereNotNull('pedidos.vehiculo_id')
                    ->where('pedidos.estado_flete','=',1)
                    ->select('transportistas.nombre_transportista','transportistas.id')
                    ->groupBy('transportistas.id')
                    ->get();
        $transportistas = Transportista::all(); 
        $merged = $pedidos_cliente->merge($pedidos_grifo);
        $pedidos = $merged->all(); 

        return $pedidos;
    }

    /**
     * Recibe un array de los fletes seleccionados, 
     * busca estos en pedidos cliente y pedidos grifo
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $id = $request->id_transportista;
        $array_selected = $request->id;
       

        if( $array_selected == null ){
            return back()->with('alert-type', 'error')->with('status', 'Seleccione algun flete');
        }        
        else{

            $pedidos_cliente
                         = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                        ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
                        ->join('pedido_proveedor_clientes','pedido_proveedor_clientes.pedido_id','=','pedidos.id')
                        ->join('pedido_clientes','pedido_clientes.id','=','pedido_proveedor_clientes.pedido_cliente_id')
                        ->join('clientes','clientes.id','=','pedido_clientes.cliente_id')
                        ->join('plantas','plantas.id','=','pedidos.planta_id')
                        ->whereNotNull('pedidos.vehiculo_id')
                        ->where('pedidos.estado_flete','=',1)
                        ->where('transportistas.id','=',$id) 
                        ->whereIn('pedidos.id',$array_selected)                   
                        ->select('pedido_clientes.fecha_descarga', 'clientes.razon_social',
                                'pedido_clientes.galones','pedidos.costo_flete',
                                'pedidos.scop','pedidos.nro_pedido',
                                'plantas.planta', 'pedidos.id',
                                'transportistas.nombre_transportista')
                        ->get();

            $pedidos_grifo = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                        ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
                        ->join('plantas','plantas.id','=','pedidos.planta_id')
                        ->join('pedido_grifos','pedido_grifos.pedido_id','=','pedidos.id')
                        ->join('grifos','pedido_grifos.grifo_id','=','grifos.id')                    
                        ->whereNotNull('pedidos.vehiculo_id')
                        ->where('pedidos.estado_flete','=',1)
                        ->where('transportistas.id','=',$id)   
                        ->whereIn('pedidos.id',$array_selected)                       
                        ->select('grifos.razon_social','pedidos.costo_flete',
                                'pedido_grifos.asignacion as galones',                            
                                'pedidos.scop','pedidos.nro_pedido',
                                'plantas.planta','pedidos.id',
                                'transportistas.nombre_transportista'
                                ,'pedido_grifos.fecha_descarga')
                        ->get();
            $transportistas = Transportista::all();

            $collection = collect([$pedidos_grifo, $pedidos_cliente]);
            $collapsed = $collection->collapse();
            $pedidos =$collapsed->all();

            $transportista = Transportista::findOrFail($id);        

            $date = Carbon::now()->format('d/m/Y');

            $subtotal = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                                ->join('transportistas','transportistas.id','vehiculos.transportista_id')
                                ->whereNotNull('pedidos.vehiculo_id')
                                ->where('transportistas.id',$id)
                                ->where('pedidos.estado_flete',1)
                                ->whereIn('pedidos.id',$array_selected)   
                                ->sum('pedidos.costo_flete');



            $lista_descuento1

                         = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                        ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
                        ->join('pedido_proveedor_clientes','pedido_proveedor_clientes.pedido_id','=','pedidos.id')
                        ->join('pedido_clientes','pedido_clientes.id','=','pedido_proveedor_clientes.pedido_cliente_id')
                        ->join('clientes','clientes.id','=','pedido_clientes.cliente_id')
                        ->join('plantas','plantas.id','=','pedidos.planta_id')
                        ->whereNotNull('pedidos.vehiculo_id')
                        ->whereNotNull('pedido_proveedor_clientes.faltante')
                        ->where('pedidos.estado_flete','=',1)
                        ->where('transportistas.id','=',$id) 
                        ->whereIn('pedidos.id',$array_selected)   
                        ->select('pedido_clientes.fecha_descarga', 'clientes.razon_social',
                                'pedido_clientes.galones','pedido_clientes.horario_descarga',
                                'pedidos.scop','pedidos.nro_pedido','pedidos.id',
                                'plantas.planta', 'pedidos.estado_flete',
                                'transportistas.nombre_transportista','pedido_clientes.observacion','pedidos.costo_galon',
                                'pedido_proveedor_clientes.faltante',
                                'pedido_proveedor_clientes.grifero',
                                'pedido_proveedor_clientes.descripcion')
                        ->get();

            $lista_descuento2 = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                        ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
                        ->join('plantas','plantas.id','=','pedidos.planta_id')
                        ->join('pedido_grifos','pedido_grifos.pedido_id','=','pedidos.id')
                        ->join('grifos','pedido_grifos.grifo_id','=','grifos.id')                    
                        ->whereNotNull('pedidos.vehiculo_id')
                        ->whereNotNull('pedido_grifos.faltante')
                        ->where('transportistas.id',$id)
                        ->where('pedidos.estado_flete',1)
                        ->whereIn('pedidos.id',$array_selected) 
                        ->select('grifos.razon_social',
                                'pedido_grifos.asignacion as galones','pedidos.costo_galon',                            
                                'pedidos.scop','pedidos.nro_pedido','pedidos.id',
                                'plantas.planta', 'pedidos.estado_flete',
                                'transportistas.nombre_transportista',
                                'pedido_grifos.faltante',
                                'pedido_grifos.grifero',
                                'pedido_grifos.descripcion','pedido_grifos.fecha_descarga')
                        ->get();

            $collection = collect([$lista_descuento1, $lista_descuento2]);
            $collapsed = $collection->collapse();
            $lista_descuento =$collapsed->all();

            $desc = 0;
            foreach ($lista_descuento as $faltante){              
            $desc += number_format((float)
                                    $faltante->faltante * $faltante->costo_galon, 2, '.', '');
            }

 
        return view('pago_transportistas.index',
            compact('pedidos','date','transportista','subtotal','lista_descuento','desc','array_selected')); 
        }    


    //   return $pedidos;
    //  return $lista_descuento;
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Faltante  $faltante
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pedidosToSelect = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                    ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
                    ->where('transportistas.id',$id)
                    ->where('pedidos.estado_flete','=',1)
                    ->select('transportistas.nombre_transportista','pedidos.*')
                    ->get();
        $id_transportista = $id;
        //return $pedidosToSelect;
        return view( 'pago_transportistas.pago_fletes_selected.index', compact('pedidosToSelect','id_transportista') );
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\Faltante  $faltante
     * @return \Illuminate\Http\Response
     */
    public function edit(Faltante $faltante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Faltante  $faltante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faltante $faltante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\Faltante  $faltante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faltante $faltante)
    {
        //
    }
}
