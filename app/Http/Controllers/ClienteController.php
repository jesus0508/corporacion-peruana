<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Cliente;
use CorporacionPeru\Http\Requests;
use Illuminate\Http\Request\StoreClienteRequest;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(StoreClienteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
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
