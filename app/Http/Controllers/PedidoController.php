<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Proveedor;
use CorporacionPeru\Planta;
use CorporacionPeru\Http\Requests;
use CorporacionPeru\Http\Requests\StorePedidoRequest;
use Illuminate\Http\Request;
use CorporacionPeru\Pedido;


class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pedidos=Pedido::all();
        $plantas = Planta::all();
        return view('pedidosP.index',compact('pedidos','plantas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            //$pedido=Pedido::all();
        $plantas = Planta::all();


         return view('pedidosP.create', compact('plantas'));
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
          Pedido::create($request->validated());
          return  back()->with('alert-type','success')->with('status','Pedido creado con exito');
    }

        /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
        //FUNCION PARA PROCESAR LOS PEDIDOS
    public function show(Request $request, Pedido $pedido)
    {
       $pedido = Pedido::find($pedido->id);
        //si el ruc editado es el mismo, se edita lo demás

            $monto_pago = $request->get('monto_pago');
            $costo_total = $pedido->galones*$pedido->costo_galon;
            //$monto_total =  

            if( null == $pedido->saldo) {
                
                $monto_restante = $costo_total;


            }else{

                 $monto_restante = $pedido->saldo;

             }


            if($monto_restante-$monto_pago == 0) {
                $pedido->estado = 3;
                $pedido->saldo = 0;
                $pedido->nro_factura = 'FF03-000'.$pedido->id;
                $pedido->save();

              return  back()->with('alert-type','success')->with('status','Pedido procesado con exito');

                # code...
            } elseif ($monto_restante-$monto_pago >0) 

            {
                        $pedido->estado = 2;
                        $pedido->saldo = $monto_restante - $monto_pago;
                        $pedido->save();

                        return  back()->with('alert-type','success')->with('status','Inicio de proceso de pago de pedido con exito');


                     }

            else{

               return  back()->with('alert-type','warning')->with('status','Limite de pago excedido, try again');
            }                   
           


    }


        /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        return $pedido;
      

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
   public function update(Request $request, Pedido $pedido)
    {
        
        $pedido = Pedido::find($pedido->id);
        //si el ruc editado es el mismo, se edita lo demás


            $pedido->scop = $request->get('scop');
            $pedido->planta = $request->get('planta');                        
            $var = $request->get('fecha_despacho');
            $pedido->fecha_despacho =  date("Y-m-d", strtotime($var) );
            $pedido->galones = $request->get('galones');
            $pedido->costo_galon = $request->get('costo_galon');

        if($request->get('nro_pedido') == $pedido->nro_pedido){
           
            $pedido->save();
         return  back()->with('alert-type','success')->with('status','Pedido editado con exito');

        } else {//sino, vemos si ya existe ese nro_pedido

               $count = Pedido::where('nro_pedido', $request->get('nro_pedido'))->count();
                if ($count>0) {
                    
                    return  back()->with('alert-type','error')->with('status','Pedido no editado, nro_pedido ya existe');
                    
                }else{

                    $pedido->nro_pedido = $request->get('nro_pedido');
                  
                    $pedido->save();

                    return  back()->with('alert-type','success')->with('status','Pedido editado con exito');

                }
                
        

            }


    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
       
        Pedido::destroy($pedido->id);
        echo $pedido;
    
     //   return  back()->with('status','Pedido borrado con exito');
    }

}