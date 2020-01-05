<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\PagoTransportista;
use CorporacionPeru\PedidoProveedorGrifo;
use CorporacionPeru\PedidoProveedorCliente;
use CorporacionPeru\Transportista;
use CorporacionPeru\Pedido;
use CorporacionPeru\Http\Requests\StorePagoTransportistaRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PagoTransportistaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transportistas = Transportista::all();

        $pagos1=PagoTransportista::join('pedido_proveedor_clientes','pago_transportistas.id','=',
            'pedido_proveedor_clientes.pago_transportista_id')
            ->join('pedidos','pedidos.id','pedido_proveedor_clientes.pedido_id')
            ->join('vehiculos','vehiculos.id','=','pedidos.vehiculo_id')
            ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
            ->whereNotNull('pedidos.vehiculo_id')
            ->select('pago_transportistas.*','transportistas.nombre_transportista')
            ->groupBy('pago_transportistas.id')
            ->orderBy('created_at','DESC')
            ->get();

        $pagos2=PagoTransportista::join('pedido_grifos','pago_transportistas.id','=',
            'pedido_grifos.pago_transportista_id')
            ->join('pedidos','pedidos.id','=','pedido_grifos.pedido_id')
            ->join('vehiculos','vehiculos.id','=','pedidos.vehiculo_id')
            ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
            ->whereNotNull('pedidos.vehiculo_id')
            ->select('pago_transportistas.*','transportistas.nombre_transportista')
            ->groupBy('pago_transportistas.id')
            ->orderBy('created_at','DESC')
            ->get();

        $collection = collect([$pagos2, $pagos1]);
        $collapsed = $collection->collapse();
        $pagos =$collapsed->all(); 
       //return $pagos;
        return view('pago_transportistas.pagos_lista.index',compact('pagos','transportistas'));

    }

    /**
     * Muestra el RESUMEN de un pago Transportista
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePagoTransportistaRequest $request)
    {  
        //return $request->fecha_pago;
        $fecha_pago = Carbon::createFromFormat('d/m/Y',$request->fecha_pago )->format('Y-m-d'); 
        $array_selected = $request->array_selected;
        $pago = PagoTransportista::create( $request->validated() ); 
        $pago->fecha_pago =  $fecha_pago;
        $pago->save();

        $id = $request->transportista_id;
        $transportista = Transportista::findOrFail($id);
        $transportista->descuento_pendiente += $request->pendiente_dejado;
        $transportista->save();
        //1ero PAGO A SUS PEDIDOS CLIENTE
        $pedidos_cliente
                     = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                    ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
                    ->join('pedido_proveedor_clientes','pedido_proveedor_clientes.pedido_id','=','pedidos.id')
                    ->join('pedido_clientes','pedido_clientes.id','=','pedido_proveedor_clientes.pedido_cliente_id')
                    ->whereNotNull('pedidos.vehiculo_id')
                    ->whereIn('pedidos.id',$array_selected)
                    //->where('pedidos.estado_flete','=',1)
                    ->where('transportistas.id','=',$id)                    
                    ->select('pedido_proveedor_clientes.id','pedidos.id as pedido_id')
                    ->get();

        foreach ( $pedidos_cliente as $pivote ) {
            $pedido_prov_cliente = PedidoProveedorCliente::findOrFail( $pivote->id );
            $pedido_prov_cliente->timestamps  = false;
            $pedido_prov_cliente->pago_transportista_id = $pago->id;
            $pedido_prov_cliente->save();
            //estado flete
            $pedido = Pedido::findOrFail( $pivote->pedido_id );
            $pedido->estado_flete = 2;
            $pedido->save();
        }

       //2do PAGO A SUS PEDIDOS GRFIOSS
        $pedidos_grifo = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                    ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
                    ->join('pedido_grifos','pedido_grifos.pedido_id','=','pedidos.id')
                    ->join('grifos','pedido_grifos.grifo_id','=','grifos.id')              
                    ->whereNotNull('pedidos.vehiculo_id')
                    ->whereIn('pedidos.id',$array_selected)
                    //->where('pedidos.estado_flete','=',1)
                    ->where('transportistas.id','=',$id)                      
                    ->select('pedido_grifos.id','pedidos.id as pedido_id')
                    ->get();
        foreach ($pedidos_grifo as $pivote) {
            $pedido_prov_grifo = PedidoProveedorGrifo::findOrFail($pivote->id);
            $pedido_prov_grifo->timestamps = false;
            $pedido_prov_grifo->pago_transportista_id = $pago->id;
            $pedido_prov_grifo->save();
            $pedido = Pedido::findOrFail( $pivote->pedido_id );
            $pedido->estado_flete = 2;
            $pedido->save();
        }

        return 
        redirect()->route('pago_transportistas.index')->with('alert-type','success')->with('status','Pago Realizado con éxito');
    

    }

    /**
     * Mostrar resumen de  1 pago transportista
     *
     * @param  \CorporacionPeru\$id del pago a transportista
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pedidos_cliente
            = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
                ->join('pedido_proveedor_clientes','pedido_proveedor_clientes.pedido_id','=','pedidos.id')
                ->join('pedido_clientes','pedido_clientes.id','=','pedido_proveedor_clientes.pedido_cliente_id')
                ->join('clientes','clientes.id','=','pedido_clientes.cliente_id')
                ->join('plantas','plantas.id','=','pedidos.planta_id')
                ->where('pedido_proveedor_clientes.pago_transportista_id','=',$id)                
                ->select('pedido_clientes.fecha_descarga', 'clientes.razon_social',
                            'pedido_clientes.galones','pedidos.costo_flete',
                            'pedidos.scop','pedidos.nro_pedido',
                            'plantas.planta', 'pedido_proveedor_clientes.id',
                            'transportistas.id as transportista_id',
                            'transportistas.nombre_transportista')
                ->get();

        $pedidos_grifo = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                    ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
                    ->join('plantas','plantas.id','=','pedidos.planta_id')
                    ->join('pedido_grifos','pedido_grifos.pedido_id','=','pedidos.id')
                    ->join('grifos','pedido_grifos.grifo_id','=','grifos.id')                    
                    ->where('pedido_grifos.pago_transportista_id','=',$id)                    
                    ->select('grifos.razon_social','pedidos.costo_flete',
                            'pedido_grifos.asignacion as galones', 
                            'pedido_grifos.fecha_descarga',
                            'transportistas.id as transportista_id',                                                                                   
                            'pedidos.scop','pedidos.nro_pedido',
                            'plantas.planta','pedido_grifos.id',
                            'transportistas.nombre_transportista')
                    ->get();

        $merged = $pedidos_cliente->merge($pedidos_grifo);
        $pedidos = $merged->all();   
        // $collection = collect([$pedidos_grifo, $pedidos_cliente]);
        // $collapsed = $collection->collapse();
        // $pedidos =$collapsed->all();
        $subtotal = 0;
        foreach ($pedidos as $pedido) {
            $subtotal += $pedido->costo_flete;
        }
        $pago_transportista = PagoTransportista::findOrFail($id); 
        $transportista = Transportista::findOrFail( $pedidos[0]->transportista_id );

        $lista_descuento1

                     = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                    ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
                    ->join('pedido_proveedor_clientes','pedido_proveedor_clientes.pedido_id','=','pedidos.id')
                    ->join('pedido_clientes','pedido_clientes.id','=','pedido_proveedor_clientes.pedido_cliente_id')
                    ->join('clientes','clientes.id','=','pedido_clientes.cliente_id')
                    ->join('plantas','plantas.id','=','pedidos.planta_id')
                    ->where('pedido_proveedor_clientes.pago_transportista_id','=',$id)
                    ->whereNotNull('pedido_proveedor_clientes.faltante')                 
                    ->select('pedido_clientes.fecha_descarga', 'clientes.razon_social',
                            'pedido_clientes.galones','pedido_clientes.horario_descarga',
                            'pedidos.scop','pedidos.nro_pedido','pedidos.id',
                            'plantas.planta', 'pedidos.estado_flete',
                            'transportistas.nombre_transportista','pedido_clientes.observacion','pedidos.costo_galon',
                            'pedido_proveedor_clientes.faltante',
                            'pedido_proveedor_clientes.precio_galon_faltante as costo_galon',
                            'pedido_proveedor_clientes.grifero',
                            'pedido_proveedor_clientes.descripcion')
                    ->get();

        $lista_descuento2 = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                    ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
                    ->join('plantas','plantas.id','=','pedidos.planta_id')
                    ->join('pedido_grifos','pedido_grifos.pedido_id','=','pedidos.id')
                    ->join('grifos','pedido_grifos.grifo_id','=','grifos.id')                    
                    ->where('pedido_grifos.pago_transportista_id','=',$id)
                    ->whereNotNull('pedido_grifos.faltante')
                    ->select('grifos.razon_social',
                            'pedido_grifos.asignacion as galones',                            
                            'pedidos.scop','pedidos.nro_pedido','pedidos.id',
                            'plantas.planta', 'pedidos.estado_flete',
                            'transportistas.nombre_transportista',
                            'pedido_grifos.faltante',
                            'pedido_grifos.precio_galon_faltante as costo_galon',
                            'pedido_grifos.grifero',
                            'pedido_grifos.descripcion')
                    ->get();

            $collection = collect([$lista_descuento1, $lista_descuento2]);
            $collapsed = $collection->collapse();
            $lista_descuento =$collapsed->all();

        //descuento
        $desc = 0;
        foreach ($lista_descuento as $faltante){              
        $desc += number_format((float)
                                    $faltante->faltante * $faltante->costo_galon, 2, '.', '');
         }
 
       // return $lista_descuento2;
        return view('pago_transportistas.resumen.index',
            compact('pedidos','subtotal','lista_descuento', 'transportista',
                'pago_transportista','desc'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\PagoTransportista  $pagoTransportista
     * @return \Illuminate\Http\Response
     */
    public function edit(PagoTransportista $pagoTransportista)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\PagoTransportista  $pagoTransportista
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PagoTransportista $pagoTransportista)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\PagoTransportista  $pagoTransportista
     * @return \Illuminate\Http\Response
     */
    public function destroy(PagoTransportista $pagoTransportista)
    {
        //
    }
}
