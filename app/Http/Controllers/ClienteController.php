<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Cliente;
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
        $clientes=Cliente::all();
        return view('clientes.index',compact('clientes'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return $cliente;
        //return view('clientes.show',compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
        return view('clientes.edit',compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(StoreClienteRequest $request, Cliente $cliente)
    {
        //
        $cliente->update($request->validate());
        return $cliente;
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
    }
}
