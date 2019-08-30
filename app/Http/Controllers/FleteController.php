<?php

namespace CorporacionPeru\Http\Controllers;

use Illuminate\Http\Request;
use CorporacionPeru\Pedido;
use CorporacionPeru\Vehiculo;
use CorporacionPeru\Transportista;
class FleteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                    ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
                    ->join('pedido_proveedor_clientes','pedido_proveedor_clientes.pedido_id','=','pedidos.id')
                    ->join('pedido_clientes','pedido_clientes.id','=','pedido_proveedor_clientes.pedido_cliente_id')
                    ->join('clientes','clientes.id','=','pedido_clientes.cliente_id')
                    ->join('plantas','plantas.id','=','pedidos.planta_id')
                    ->whereNotNull('pedidos.vehiculo_id')
                    ->select('pedido_clientes.fecha_descarga', 'clientes.razon_social',
                            'pedido_clientes.galones','pedido_clientes.horario_descarga',
                            'pedidos.scop','pedidos.nro_pedido','pedidos.id',
                            'plantas.planta', 'pedidos.estado_flete',
                            'transportistas.nombre_transportista','pedido_clientes.observacion')
                    ->get();
        $transportistas = Transportista::all();            
       // return $pedidos;
        return view('transportistas.flete.index',compact('pedidos','transportistas'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
