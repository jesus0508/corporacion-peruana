<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\PagoProveedor;
use CorporacionPeru\Pedido;
use CorporacionPeru\Planta;
use CorporacionPeru\Proveedor;
use Illuminate\Http\Request;
use CorporacionPeru\Http\Requests\StorePagoProveedorRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PagoProveedorController extends Controller
{
    public function resumen_pago($idPago){

        $pedidos = Pedido::join('pago_pedido_proveedors', 'pedidos.id', '=', 'pago_pedido_proveedors.pedido_id')->join('pago_proveedors', 'pago_proveedors.id', '=', 'pago_pedido_proveedors.pago_proveedor_id')->where('pago_proveedor_id',$idPago)->get();
        //return 
        $pedido1 = $pedidos->first();
        $planta = Planta::findOrFail($pedido1->planta_id);

        $pago_proveedor = PagoProveedor::findOrFail($idPago);
        $proveedor = Proveedor::findOrFail($planta->proveedor_id);
        //return $pedidos;
        return view('pago_proveedores.resumen.index',compact('pago_proveedor','proveedor','pedidos'));

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$pagos=PagoProveedor::all();
        //return view('pago_clientes.index',compact('pagos'));
        //
        $proveedores = Proveedor::all();
        $pagos = 
            PagoProveedor::join('pago_pedido_proveedors', 'pago_proveedors.id' ,'=','pago_pedido_proveedors.pago_proveedor_id')
                ->join('pedidos','pedidos.id','=','pago_pedido_proveedors.pedido_id')
                ->join('plantas','plantas.id','=','pedidos.planta_id')
                ->join('proveedores','proveedores.id','=','plantas.proveedor_id')
                ->select('pago_proveedors.*' , 'proveedores.razon_social')
                ->groupBy('pago_proveedors.id')
                ->orderBy('created_at','DESC')
                ->get();

  
      // $pagos=PagoProveedor::with('pedidos')->get();
       //return $pagos;   
       return view('pago_proveedores.pagos_lista.index',compact('pagos','proveedores'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        
        $proveedores = Proveedor::
            leftJoin('plantas','plantas.proveedor_id','=','proveedores.id')
            ->leftJoin('pedidos','pedidos.planta_id','=','plantas.id')         
            //->where('sum(pedidos.saldo)','!=',null)
            ->groupBy('proveedores.id')
            ->select(
                'proveedores.*'
                ,DB::raw('sum(pedidos.saldo)')
                 
            )
            
            ->get(); 

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

            $pagoProveedor = new PagoProveedor;
            $request->validated();
            $pagoProveedor->codigo_operacion =$request->codigo_operacion;
            $pagoProveedor->monto_operacion=$request->monto_operacion;
            $pagoProveedor->banco=$request->banco;
            $pagoProveedor->setFechaFacturaAttribute($request->fecha_operacion);
            $pagoProveedor->save();

        	$proveedor = Proveedor::with('plantas')->where('id', '=' , $request->proveedor_id)->first();
        	$pedidos = array();
        	foreach ($proveedor->plantas as $planta) {//para obtener tods los pedidos del proveedor X
                $planta_id = $planta->id;
                $pedidos[] = Pedido::where('planta_id','=',$planta_id)->whereNotNull('factura_proveedor_id')->where('estado','!=',1)->where('estado','!=',5)->with('planta')->with('facturaProveedor')->get();
                $pedidos = collect($pedidos);//volver coleccion
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
                        $asignacion = $dinero_stock;
                        $pedido->estado = 4;
                    	$dinero_stock = 0;
                    		//se le asigna el pedido proveedor al  pago
                   //
                    	$pedido->pagosProveedor()->attach($pago_proveedor->id,['asignacion'=> $asignacion]);//agregar asignaci?
                    	$pedido->save();
                    	break; 

            		} else{//si el stockDinero es mayor a lo q se va distribuir

                     	$dinero_stock -= $pedido->saldo;
                        $asignacion = $pedido->saldo;
                    	$pedido->saldo = 0;
                    	$pedido->estado = 5;//isPaid
                    ///se le asigna el pedido proveedor al  pago
                    	$pedido->pagosProveedor()->attach($pago_proveedor->id,['asignacion'=> $asignacion ]);
                    	$pedido->save();
  
            		}

        		}
        	}
        	DB::commit();
            Session::flash('alert-type', 'info');
            Session::flash('status', 'Pago realizado con exito');
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
        	$pedidos[] = Pedido::where('planta_id','=',$planta_id)->whereNotNull('factura_proveedor_id')->where('estado','!=',5)->with('planta')->with('facturaProveedor')->get();
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
    public function edit($idPedido)
    {
        $pedido = Pedido::where('id',$idPedido)->with('facturaProveedor')->with('planta')->first();
       // ->with('facturaProveedor')->with('pagosProveedor');
        $id_proveedor = $pedido->planta->proveedor_id;
        $proveedor = Proveedor::findOrFail($id_proveedor);
        $pagos =  
        PagoProveedor::join('pago_pedido_proveedors', 'pago_proveedors.id' ,'=','pago_pedido_proveedors.pago_proveedor_id')
                ->join('pedidos','pedidos.id','=','pago_pedido_proveedors.pedido_id')
                ->select('pago_proveedors.*' , 'pago_pedido_proveedors.asignacion')
                ->where('pedidos.id',$idPedido)
                ->get();
      //  return $pagos;
        return view('pedidosP.show_pagos.index',compact('pedido','proveedor','pagos'));
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
