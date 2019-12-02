<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Http\Requests\StoreDepositoRequest;
use CorporacionPeru\Deposito;
use Illuminate\Http\Request;
use CorporacionPeru\Cuenta;
use CorporacionPeru\Banco;
use CorporacionPeru\PagoCliente;
use Carbon\Carbon;


class DepositoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $depositos1 = Deposito::join('cuentas','cuentas.id','=','depositos.cuenta_id')
            ->join('bancos','bancos.id','=','cuentas.banco_id')
            ->select('depositos.*','bancos.abreviacion','bancos.banco','cuentas.nro_cuenta')
            ->get();

        $depositos2 = PagoCliente::join('pago_cliente_pedido_cliente','pago_cliente_pedido_cliente.pago_cliente_id','=','pago_clientes.id')
            ->join('pedido_clientes','pedido_clientes.id','=','pago_cliente_pedido_cliente.pedido_cliente_id')
            ->join('clientes','clientes.id','=','pedido_clientes.cliente_id')
            //->where('categoria_ingresos',1)//DEPÓSITO por VENTA CLIENTE DIRECTO
            ->select('pago_clientes.codigo_operacion','pago_clientes.monto_operacion as monto','pago_clientes.banco','pago_clientes.fecha_operacion as fecha_deposito',
                'clientes.razon_social as detalle')
            ->get();
        $collection = collect([$depositos1, $depositos2 ]);
        $collapsed = $collection->collapse();
        $depositos =$collapsed->all(); 

        return view('depositos.diario.index', compact('depositos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cuentas = Cuenta::with('banco')->get();
        $depositos = Deposito::with('cuenta')->get();
       // return $cuentas;

        return view('depositos.index',compact('cuentas','depositos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepositoRequest $request)
    {
       Deposito::create($request->validated());                     
        return back()->with('alert-type', 'success')->with('status', 'Depósito Registrado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Deposito  $deposito
     * @return \Illuminate\Http\Response
     */
    public function show(Deposito $deposito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\Deposito  $deposito
     * @return \Illuminate\Http\Response
     */
    public function edit(Deposito $deposito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Deposito  $deposito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deposito $deposito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\Deposito  $deposito
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deposito $deposito)
    {
        //
    }
}
