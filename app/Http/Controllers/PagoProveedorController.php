<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\PagoProveedor;
use CorporacionPeru\Pedido;
use CorporacionPeru\Planta;
use CorporacionPeru\Proveedor;
use Illuminate\Http\Request;
use CorporacionPeru\Http\Requests\StorePagoProveedorRequest;
use Illuminate\Support\Facades\DB;

class PagoProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pagos=PagoProveedor::all();
        return view('pago_clientes.index',compact('pagos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        $proveedores = Proveedor::where('deuda','>',0)->get();
        return $proveedores;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePagoProveedorRequest $request)
    {
    	try {

       		DB::beginTransaction();
        	PagoProveedor::create($request->validated());
        	$proveedor = Proveedor::with('plantas')->where('id', '=' , $request->proveedor_id)->first();
        	$pedidos = array();
        	foreach ($proveedor->plantas as $planta) {//para obtener tods los pedidos del proveedor X
        		$planta_id = $planta->id;
        		$pedidos[] = Pedido::where('planta_id','=',$planta_id)->where('estado','=',2)->with('planta')->with('facturaProveedor')->get();
        		$pedidos = collect($pedidos);
        	}
        	$pedidos = $pedidos->collapse();
        	$pago_proveedor = PagoProveedor::where('codigo_operacion','=',$request->codigo_operacion)->first();
        	$cantDistribuir = $request->monto_operacion;
        	$dinero_stock = $cantDistribuir;
        	foreach ($pedidos as $pedido) {
        		if( $pedido != null ){
        			$pedido = Pedido::find($pedido->id);
            		$restanteXasignar = $pedido->saldo;
            		if( $dinero_stock == 0 ){//si ya no hay para repartir
            		    break; //sale del foreach
            		}

            		//Dinero en stock <= dinero x asignar
           			if( $restanteXasignar >= $dinero_stock ){

           				$pedido->saldo -=  $dinero_stock;
                        $pedido->estado = 4;
                    	$dinero_stock = 0;
                    		//se le asigna el pedido proveedor al pedido cliente
                    	$pedido->pagosProveedor()->attach($pago_proveedor->id);//agregar asignaci?
                    	$pedido->save();
                    	break; 

            		} else{//si el stockDinero es mayor a lo q se va distribuir

                     	$dinero_stock -= $pedido->saldo;
                    	$pedido->saldo = 0;
                    	$pedido->estado = 5;//isPaid
                    // se le asigna el pedido proveedor al pedido cliente
                    	$pedido->pagosProveedor()->attach($pago_proveedor->id);
                    	$pedido->save();
  
            		}

        		}
        	}
        	DB::commit();
        	 $pedidos = Pedido::join('pago_pedido_proveedors', 'pedidos.id', '=', 'pago_pedido_proveedors.pedido_id')->join('pago_proveedors', 'pago_proveedors.id', '=', 'pago_pedido_proveedors.pago_proveedor_id')->where('pago_proveedor_id',$pago_proveedor->id)->get();
        //return	$pago_proveedor;

        //$pedidos = Pedido::with('planta')->with('facturaProveedor')->with('pagosProveedor')->where('pagos_proveedor.pivot.pago_proveedor_id',$pago_proveedor->id)->get();
        return view('pago_proveedores.resumen.index',compact('pedidos','proveedor','pago_proveedor'))->with('alert-type','success')->with('status','Pago registrado con exito');

        } catch (Exception $e) {

        	DB::rollback();
        	return back()->with('alert-type','error')->with('status','Ocurrió un error en el proceso');
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\PagoProveedor  $pagoProveedor
     * @return \Illuminate\Http\Response
     */
    public function show($idProveedor)
    {
        $proveedor = Proveedor::with('plantas')->where('id', '=' , $idProveedor)->first();
        $pedidos = array();
        foreach ($proveedor->plantas as $planta) {
        	$planta_id = $planta->id;
        	$pedidos[] = Pedido::where('planta_id','=',$planta_id)->where('estado','=',2)->with('planta')->with('facturaProveedor')->get();
        	$pedidos = collect($pedidos);//volver coleccion

        }
        //en pedidos se almacenara los pedidos de  todas las plantas del proveedor selected
        $pedidos = $pedidos->collapse();
        //$pedidos = $pedidos->sortBy('id');
       // return $pedidos;


        return view('pago_proveedores.index',compact('pedidos','proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\PagoProveedor  $pagoProveedor
     * @return \Illuminate\Http\Response
     */
    public function edit(PagoProveedor $pagoProveedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\PagoProveedor  $pagoProveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PagoProveedor $pagoProveedor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\PagoProveedor  $pagoProveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(PagoProveedor $pagoProveedor)
    {
        //
    }
}
