<?php

namespace CorporacionPeru\Http\Controllers;

use Illuminate\Http\Request;
use CorporacionPeru\Pedido;
use CorporacionPeru\Grifo;
use CorporacionPeru\Vehiculo;
use CorporacionPeru\Transportista;
use CorporacionPeru\PedidoProveedorGrifo;
use CorporacionPeru\PedidoProveedorCliente;
use CorporacionPeru\Http\Requests\UpdatePedidoProveedorClienteRequest;

class FleteController extends Controller
{


    /**
     * Muestra todos los fletes, a clientes y grifos.
     * Ya sean pagado, sin pagar o con descuento.
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
                    ->select('pedido_clientes.fecha_descarga', 'clientes.razon_social',
                            'pedido_clientes.galones',
                            'pedido_clientes.horario_descarga',
                            'pedidos.scop','pedidos.nro_pedido','pedidos.id',
                            'plantas.planta', 'pedidos.estado_flete',
                            'pedido_proveedor_clientes.faltante',
                            'transportistas.nombre_transportista','pedido_clientes.observacion')
                    ->get();

        $pedidos_grifo = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                    ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
                    ->join('plantas','plantas.id','=','pedidos.planta_id')
                    ->join('pedido_grifos','pedido_grifos.pedido_id','=','pedidos.id')
                    ->join('grifos','pedido_grifos.grifo_id','=','grifos.id')                    
                    ->whereNotNull('pedidos.vehiculo_id')
                    ->select('grifos.razon_social',
                            'pedido_grifos.asignacion as galones',                            
                            'pedidos.scop','pedidos.nro_pedido','pedidos.id',
                            'plantas.planta', 'pedidos.estado_flete',
                            'transportistas.nombre_transportista',
                            'pedido_grifos.hora_descarga as horario_descarga',
                            'pedido_grifos.faltante','pedido_grifos.fecha_descarga' )
                    ->get();
        $transportistas = Transportista::all(); 
        // $merged = $pedidos_cliente->merge($pedidos_grifo);
        // $pedidos = $merged->all();   
        $collection = collect([$pedidos_grifo, $pedidos_cliente]);
        $collapsed = $collection->collapse();
        $pedidos =$collapsed->all(); 

       // return $pedidos;
        return view('transportistas.flete.index',compact('pedidos','transportistas'));
    }

    /**
     * Muestra la tabla fletes para asignar faltantes.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pedidos_grifo = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                    ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
                    ->join('plantas','plantas.id','=','pedidos.planta_id')
                    ->join('pedido_grifos','pedido_grifos.pedido_id','=','pedidos.id')
                    ->join('grifos','pedido_grifos.grifo_id','=','grifos.id')                  
                    ->whereNotNull('pedidos.vehiculo_id')
                    ->whereNull('pedido_grifos.faltante')
                    ->where('pedidos.estado_flete','=',1)
                    ->select('grifos.razon_social',
                            'pedido_grifos.asignacion as galones',                            
                            'pedidos.scop','pedidos.nro_pedido','pedidos.id',
                            'plantas.planta', 'pedidos.estado_flete',
                            'transportistas.nombre_transportista',
                            'pedido_grifos.faltante',
                            'pedido_grifos.grifero',
                            'pedido_grifos.id as id_pivote',
                            'pedido_grifos.descripcion','pedido_grifos.fecha_descarga')
                    ->get();
        $pedidos_cliente = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                    ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
                    ->join('pedido_proveedor_clientes','pedido_proveedor_clientes.pedido_id','=','pedidos.id')
                    ->join('pedido_clientes','pedido_clientes.id','=','pedido_proveedor_clientes.pedido_cliente_id')
                    ->join('clientes','clientes.id','=','pedido_clientes.cliente_id')
                    ->join('plantas','plantas.id','=','pedidos.planta_id')
                    ->whereNotNull('pedidos.vehiculo_id')
                    ->whereNull('pedido_proveedor_clientes.faltante')
                    ->select('pedido_clientes.fecha_descarga', 'clientes.razon_social',
                            'pedido_clientes.galones','pedido_clientes.horario_descarga',
                            'pedidos.scop','pedidos.nro_pedido','pedidos.id',
                            'pedido_clientes.id as pedido_cliente_id',
                            'plantas.planta', 'pedidos.estado_flete',
                            'transportistas.nombre_transportista',
                            'pedido_clientes.observacion',
                            'pedido_proveedor_clientes.faltante',
                            'pedido_proveedor_clientes.grifero',
                            'pedido_proveedor_clientes.id as id_pivote',
                            'pedido_proveedor_clientes.descripcion')
                    ->get();
      //  $merged = $pedidos_cliente->merge($pedidos_grifo);
     //   $pedidos = $merged->all(); 
        $collection = collect([$pedidos_grifo, $pedidos_cliente]);
        $collapsed = $collection->collapse();
        $pedidos =$collapsed->all(); 
     //  return $pedidos;
       return view('transportistas.registrar_faltante.index',compact('pedidos'));      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Obtener los datos del modal registrar faltante.
     * FLETE DE UN GRIFO PROPIO
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pedido = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                    ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
                    ->join('pedido_grifos','pedido_grifos.pedido_id','=','pedidos.id')
                    ->join('grifos','pedido_grifos.grifo_id','=','grifos.id') 
                    ->where('pedido_grifos.id',$id)
                    ->select('pedido_grifos.id as id_pivote',
                            'pedido_grifos.descripcion',
                            'pedidos.costo_galon','transportistas.nombre_transportista',
                            'grifos.razon_social')
                    ->first();   
       return $pedido;       
    }

    /**
     * Obtener los datos del modal registrar faltante.
     * FLETE DE PEDIDO DE UN CLIENTE
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pedido = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                    ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
                    ->join('pedido_proveedor_clientes','pedido_proveedor_clientes.pedido_id','=','pedidos.id')
                    ->join('pedido_clientes','pedido_clientes.id','=','pedido_proveedor_clientes.pedido_cliente_id')
                    ->join('clientes','clientes.id','=','pedido_clientes.cliente_id')
                    ->where('pedido_proveedor_clientes.id',$id)
                    ->select('pedido_proveedor_clientes.id as id_pivote',
                            'pedido_proveedor_clientes.descripcion',
                            'pedido_clientes.id as pedido_cliente_id',
                            'pedidos.costo_galon','transportistas.nombre_transportista',
                            'pedido_clientes.fecha_descarga','clientes.razon_social')
                    ->first();

        return $pedido;            
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePedidoProveedorClienteRequest $request, $id)
    {   
        //TRANSACTION
        $id = $request->id;//id_pivote     
        if( $request->pedido_cliente_id){//PEDIDO A CLEINTE            
            $pivote = PedidoProveedorCliente::findOrFail($id);            
        }else{//PEDIDO A GRIFO
            $pivote = PedidoProveedorGrifo::findOrFail($id); 
            $grifo = Grifo::findOrFail($id);
            $grifo->stock-=$request->faltante;
            $grifo->save();        
        }
        $pivote->timestamps  = false;
        $pivote->update( $request->validated() );

        return  back()->with('alert-type', 'success')->with('status', 'Faltante registrado con exito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
