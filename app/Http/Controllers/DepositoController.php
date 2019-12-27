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
        $depositos = Deposito::with('cuenta')->take(100)->get();
       // return $cuentas;

        return view('depositos.index',compact('cuentas','depositos'));
    }

    public function getDepositosByDay($fecha = null){
        if ($fecha==null) {
            $fecha = Carbon::now()->format('Y-m-d');
        }

        $depositos1 = Deposito::join('cuentas','cuentas.id','=','depositos.cuenta_id')
            ->join('bancos','bancos.id','=','cuentas.banco_id')
            ->where('depositos.fecha_reporte',$fecha)
            ->select('depositos.*','cuentas.nro_cuenta');         
        return datatables()->of($depositos1)
            ->addColumn('action', 'depositos.modify.actions')->make(true);
            //->rawColumns(['actions'])
            //->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $deposito = Deposito::where('id',$id)->first();
        $cuentas = Cuenta::with('banco')->get();
        return response()->json(['deposito' => $deposito ,                                
                                'cuentas' => $cuentas ]);
    }

    /**
     * Redirecciona a la vista modificar Depósitos
     */
    public function modify(){
        $cuentas = Cuenta::with('banco')->get();
        $today = Carbon::now()->format('d/m/Y');
        return view('depositos.modify.index',compact('today'));
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Deposito  $deposito
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDepositoRequest $request)
    {
        $id = $request->id;
        Deposito::findOrFail($id)->update($request->validated());
        return back()->with('alert-type', 'success')->with('status', 'Depósito Actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\Deposito  $deposito
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deposito = Deposito::findOrFail($id);
        $deposito->delete();
        return  back()->with('alert-type', 'warning')->with('status', 'Depósito eliminado con exito');
    }
}
