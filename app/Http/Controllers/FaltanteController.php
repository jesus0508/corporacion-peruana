<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Faltante;
use Illuminate\Http\Request;
use CorporacionPeru\Pedido;
use CorporacionPeru\Vehiculo;
use CorporacionPeru\Transportista;
use CorporacionPeru\PedidoProveedorGrifo;
use CorporacionPeru\PedidoProveedorCliente;
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
                    ->select('pedido_clientes.fecha_descarga', 'clientes.razon_social',
                            'pedido_clientes.galones','pedido_clientes.horario_descarga',
                            'pedidos.scop','pedidos.nro_pedido','pedidos.id',
                            'plantas.planta', 'pedidos.estado_flete',
                            'transportistas.nombre_transportista','pedido_clientes.observacion','pedidos.costo_galon',
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
                    ->select('grifos.razon_social',
                            'pedido_grifos.asignacion as galones','pedidos.costo_galon',                            
                            'pedidos.scop','pedidos.nro_pedido','pedidos.id',
                            'plantas.planta', 'pedidos.estado_flete',
                            'transportistas.nombre_transportista',
                            'pedido_grifos.faltante',
                            'pedido_grifos.grifero',
                            'pedido_grifos.descripcion')
                    ->get();
        $merged = $pedidos_cliente->merge($pedidos_grifo);
        $pedidos = $merged->all();  
       return view('transportistas.lista_faltantes.index',compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Faltante  $faltante
     * @return \Illuminate\Http\Response
     */
    public function show(Faltante $faltante)
    {
        //
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
