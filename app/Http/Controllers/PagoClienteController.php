<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Cliente;
use CorporacionPeru\PagoCliente;
use CorporacionPeru\PedidoCliente;
use Illuminate\Http\Request;
use CorporacionPeru\Http\Requests\StorePagoRequest;
use CorporacionPeru\Http\Requests\StorePagoBloqueRequest;
use Illuminate\Support\Facades\DB;
use Log;

class PagoClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pagos=PagoCliente::all();
        return view('pago_clientes.index',compact('pagos'));
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
    public function store(StorePagoRequest $request)
    {
        //
        $pago=PagoCliente::create($request->validated());
        $pedido_cliente=PedidoCliente::findOrFail($request->pedido_cliente_id);
        $pedido_cliente->saldo-=$request->monto_operacion;
        $pago->saldo=$pedido_cliente->saldo;
        $pedido_cliente->estado=4;
        if($pedido_cliente->saldo<=0){
            $pedido_cliente->estado=5;
        }
        $pago->save();
        $pedido_cliente->save();
        return back()->with('alert-type','success')->with('status','Pago registrado con exito');
    }

    public function pagoBloque(StorePagoBloqueRequest $request,Cliente $cliente)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\PagoCliente  $pagoCliente
     * @return \Illuminate\Http\Response
     */
    public function show(PagoCliente $pagoCliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\PagoCliente  $pagoCliente
     * @return \Illuminate\Http\Response
     */
    public function edit(PagoCliente $pagoCliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\PagoCliente  $pagoCliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PagoCliente $pagoCliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\PagoCliente  $pagoCliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(PagoCliente $pagoCliente)
    {
        //
    }
}
