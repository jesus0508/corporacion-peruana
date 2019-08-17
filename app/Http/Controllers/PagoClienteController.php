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
        $pagos = PagoCliente::with('pedidoClientes')->get();
        //dd($pagos);
        return view('pago_clientes.index', compact('pagos'));
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
        $pago = PagoCliente::create($request->validated());
        $pedido_cliente = PedidoCliente::findOrFail($request->pedido_cliente_id);
        $pedido_cliente->saldo -= $request->monto_operacion;
        $pago->saldo = $pedido_cliente->saldo;
        $pedido_cliente->estado = 4;
        if ($pedido_cliente->saldo <= 0) {
            $pago->saldo = 0;
            $pedido_cliente->estado = 5;
        }
        $pedido_cliente->pagoClientes()->attach($pago->id);
        $pago->save();
        $pedido_cliente->save();
        return back()->with('alert-type', 'success')->with('status', 'Pago registrado con exito');
    }

    public function pagoBloque(StorePagoBloqueRequest $request, Cliente $cliente)
    {
        LOG::info('Cliente ' . $cliente);
        try {
            DB::beginTransaction();
            $pago = PagoCliente::create($request->validated());
            $pedidos_cliente = PedidoCliente::where('cliente_id', $cliente->id)
                ->whereBetween('estado', [2, 4])
                ->orderBy('created_at', 'asc')
                ->get();
            $monto_actual = $pago->monto_operacion;
            foreach ($pedidos_cliente as $pedido_cliente) {
                if ($monto_actual >= $pedido_cliente->saldo) {
                    $monto_actual -= $pedido_cliente->saldo;
                    $pedido_cliente->saldo = 0;
                    $pedido_cliente->estado = 5;
                    $pedido_cliente->pagoClientes()->attach($pago->id);
                    $pedido_cliente->save();
                } else {
                    $pedido_cliente->saldo -= $monto_actual;
                    $pedido_cliente->estado = 4;
                    $pedido_cliente->pagoClientes()->attach($pago->id);
                    $pedido_cliente->save();
                    $monto_actual = 0;
                    break;
                }
            }
            if ($monto_actual > 0) {
                /** Guardar en alguna parte el excedente */
                return response()->json(['status' => 'Hubo un excedente de: ' . $monto_actual]);
            }
            DB::commit();
            return response()->json(['status' => 'Pagos registrados con exito']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'Ocurrio un error en el servidor vuelve a intentarlo']);
        }
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
