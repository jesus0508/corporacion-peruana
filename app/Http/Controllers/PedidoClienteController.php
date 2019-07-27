<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\PedidoCliente;
use CorporacionPeru\Http\Requests\StorePedidoClienteRequest;
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
        $pedido_clientes=PedidoCliente::all();
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
        $clientes=Cliente::all();
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePedidoClienteRequest $request, $id)
    {
        //
        $id=$request->id;
        PedidoCliente::findOrFail($id)->update($request->validated());
        return back()->with('alert-type','success')->with('status','Pedido editado con exito');
    }

    public function procesarPedido(ProcessPedidoClienteRequest $request){
        $pedido=PedidoCliente::findOrFail($request->id);
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
        return  back()->with('alert-type','warning')->with('status','Pedido eliminado con exito');
    }
}
