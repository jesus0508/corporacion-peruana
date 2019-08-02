<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Proveedor;
use CorporacionPeru\Planta;
use CorporacionPeru\Http\Requests;
use CorporacionPeru\Http\Requests\StorePedidoRequest;
use Illuminate\Http\Request;
use CorporacionPeru\Pedido;
use CorporacionPeru\Vehiculo;
use CorporacionPeru\Transportista;

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
        $pedidos=Pedido::with('planta')->get();
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

    public function show($id)
    {
        $pedido=Pedido::with('planta')->with('vehiculo')->with('facturaProveedor')->where('id','=',$id)->first();

        $transportista_id = $pedido->vehiculo->transportista_id;
        $transportistaCol = Transportista::find($transportista_id);
        $transportista = $transportistaCol->nombre_transportista;
                
        return view( 'facturas.show.createDirecto',compact(  'pedido' , 'transportista' ) );
     
    }


        /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $pedido = Pedido::find($id);
        $vehiculos = Vehiculo::all();
        
        return view( 'facturas.Ind.createDirecto',compact(  'pedido' , 'vehiculos' ) );
      

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
   public function update(StorePedidoRequest $request, $id)
    {
        
        Pedido::findOrFail($id)->update($request->validated());

         return  back()->with('alert-type','success')->with('status','Pedido editado con exito');
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        Pedido::destroy($id);
      
    
        return  back()->with('alert-type','warning')->with('status','Pedido borrado con exito');
    }

}