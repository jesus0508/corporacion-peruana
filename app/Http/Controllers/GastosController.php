<?php

namespace CorporacionPeru\Http\Controllers;

use Illuminate\Http\Request;

class GastosController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       // $pedidos = Pedido::with('planta')->get();
        //$plantas = Planta::all();
        return view('gastos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$plantas = Planta::all();
    	return view('gastos.registro.index');

      //  return view('pedidosP.create', compact('plantas'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePedidoRequest $request)
    {
        //
      //  Pedido::create($request->validated());
        return  back()->with('alert-type', 'success')->with('status', 'Pedido creado con exito');
    }

}
