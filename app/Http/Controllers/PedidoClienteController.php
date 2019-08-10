<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\PedidoCliente;
use CorporacionPeru\Http\Requests\StorePedidoClienteRequest;
use CorporacionPeru\Http\Requests\UpdatePedidoClienteRequest;
use CorporacionPeru\Http\Requests\ProcessPedidoClienteRequest;
use CorporacionPeru\Cliente;
use Illuminate\Http\Request;

class PedidoClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pedido_clientes=PedidoCliente::with('cliente')->get();
        $clientes=Cliente::all();
        return view('pedido_clientes.index',compact('pedido_clientes','clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $clientes=Cliente::select('id','ruc','razon_social');
        return view('pedido_clientes.create',compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePedidoClienteRequest $request)
    {
        //
        PedidoCliente::create($request->validated());
        return back()->with('alert-type','success')->with('status','Pedido Registrado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\PedidoCliente  $pedidoCliente
     * @return \Illuminate\Http\Response
     */
    public function show(PedidoCliente $pedidoCliente)
    {
        //
        $pedidoCliente->load('cliente');
        return response()->json(['pedidoCliente'=>$pedidoCliente]);
    }

    public function getDetalles($id){
        $pedidoCliente=PedidoCliente::with('cliente')->where('id',$id)->first();
        if($pedidoCliente->estado>2){
            $pedidoCliente->load('pedidos');
            return view('pedido_clientes.detalles',compact('pedidoCliente'));
        }
        return back()->with('alert-type','error')->with('status','Ocurrio un erro al ver detalles');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\PedidoCliente  $pedidoCliente
     * @return \Illuminate\Http\Response
     */
    public function edit(PedidoCliente $pedidoCliente)
    {
        //
        return response()->json(['pedidoCliente'=>$pedidoCliente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePedidoClienteRequest $request, $id)
    {
        //
        $id=$request->id;
        PedidoCliente::findOrFail($id)->update($request->validated());
        return back()->with('alert-type','success')->with('status','Pedido editado con exito');
    }

    public function procesarPedido($id){
        $pedido=PedidoCliente::findOrFail($id);
        /*Logica para actualizar pedido pendiente*/
        $pedido->estado=2;
        $pedido->save();
        return  back()->with('alert-type','success')->with('status','Pedido confirmado con exito con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\PedidoCliente  $pedidoCliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(PedidoCliente $pedidoCliente)
    {
        //
        
        $pedidoCliente->delete();
        return response()->json(['status'=>'Pedido eliminado con exito']);
    }

    public function getByRazonSocial($razon_social){
        $cliente=Cliente::where('razon_social',$razon_social)->first();
        $total_deuda=$cliente->pedidoClientes()->sum('saldo');
        return response()->json(['total_deuda'=>$total_deuda,'cliente_id'=>$cliente->id]);
    }
}
