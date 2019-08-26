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
        $pedido_clientes = PedidoCliente::with('cliente')->get();
        $clientes = Cliente::all();
        return view('pedido_clientes.index', compact('pedido_clientes', 'clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $clientes = Cliente::all('id', 'ruc', 'razon_social');
        return view('pedido_clientes.create', compact('clientes'));
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
        $pedido = PedidoCliente::create($request->validated());
        $cliente = $pedido->cliente;
        $pedidos = $cliente->pedidoClientes->where('estado', '<=', 4);
        $total_consumido = $pedidos->sum('saldo');
        if ($total_consumido >= $cliente->linea_credito) {
            return back()->with(['alert-type' => 'info', 'status' => 'Cliente excedio su limite de credito. Pedido Registrado']);
        }
        return back()->with(['alert-type' => 'info', 'status' => 'Pedido Registrado con exito']);
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
        return response()->json(['pedidoCliente' => $pedidoCliente]);
    }

    public function getDetalles($id)
    {
        $pedidoCliente = PedidoCliente::with('cliente')->where('id', $id)->first();
        if ($pedidoCliente->estado > 2) {
            $pedidoCliente->load('pedidos');
            return view('pedido_clientes.detalles', compact('pedidoCliente'));
        }
        return back()->with('alert-type', 'error')->with('status', 'Ocurrio un erro al ver detalles');
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
        return response()->json(['pedidoCliente' => $pedidoCliente]);
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
        $id = $request->id;
        PedidoCliente::findOrFail($id)->update($request->validated());
        return back()->with('alert-type', 'success')->with('status', 'Pedido editado con exito');
    }

    public function confirmarPedido(ProcessPedidoClienteRequest $request, $id)
    {
        $validated = $request->validated();
        //dd($validated);
        $id = $validated['id'];
        $pedido = PedidoCliente::findOrFail($id);
        $pedido->nro_factura = $validated['nro_factura'];
        $pedido->fecha_confirmacion = $validated['fecha_confirmacion'];
        $pedido->estado = 2;
        $pedido->save();
        return  back()->with('alert-type', 'success')->with('status', 'Pedido confirmado con exito con exito');
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
        return response()->json(['status' => 'Pedido eliminado con exito']);
    }

    public function getByRazonSocial($id)
    {
        $cliente = Cliente::where('id', $id)->first();
        $total_deuda = $cliente->pedidoClientes()->sum('saldo');
        return response()->json(['total_deuda' => $total_deuda, 'cliente_id' => $cliente->id]);
    }
}
