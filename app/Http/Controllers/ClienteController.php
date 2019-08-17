<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Cliente;
use CorporacionPeru\PedidoCliente;
use CorporacionPeru\Http\Requests;
use CorporacionPeru\Http\Requests\StoreClienteRequest;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::orderBy('id', 'DESC')->get();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClienteRequest $request)
    {
        //
        Cliente::create($request->validated());
        return back()->with('alert-type', 'success')->with('status', 'Cliente Registrado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        $pedidos = $cliente->pedidoClientes->where('estado', '<=', 4);
        $total_consumido = $pedidos->sum('saldo');
        return response()->json(['cliente' => $cliente, 'total_consumido' => $total_consumido]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return response()->json(['cliente' => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreClienteRequest $request, $id)
    {
        //
        $id = $request->id;
        Cliente::findOrFail($id)->update($request->validated());
        return  back()->with('alert-type', 'success')->with('status', 'Cliente editado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
        $exists = PedidoCliente::where('cliente_id', $cliente->id)->exists();
        if ($exists) {
            return  back()->with('alert-type', 'warning')->with('status', 'Cliente tiene un saldo pendiente');
        }
        $cliente->delete();
        return  back()->with('alert-type', 'success')->with('status', 'Cliente eliminado con exito');
    }

    public function getByTipo($tipo)
    {
        if ($tipo == 0) {
            $clientes = Cliente::select('id', 'razon_social as text')->get();
        } else {
            $clientes = Cliente::select('id', 'razon_social as text')->where('tipo', $tipo)->get();
        }
        return response()->json(['clientes' => $clientes]);
    }

    public function getAllClientes()
    {
        $clientes = Cliente::all();
        return response()->json(['clientes' => $clientes]);
    }
}
