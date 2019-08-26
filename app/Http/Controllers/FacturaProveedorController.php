<?php

namespace CorporacionPeru\Http\Controllers;

use Illuminate\Http\Request;
use CorporacionPeru\Pedido;
use CorporacionPeru\Planta;
use CorporacionPeru\Vehiculo;
use CorporacionPeru\FacturaProveedor;
use CorporacionPeru\Http\Requests\StoreFacturaProveedorRequest;
use CorporacionPeru\Http\Requests\StoreTransportistaPedidoRequest;

class FacturaProveedorController extends Controller
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
        $pedidos = Pedido::where('estado','=',1)->get();
        $vehiculos = Vehiculo::all();
        return view( 'facturas.index',compact(  'pedidos' , 'vehiculos' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFacturaProveedorRequest $request)
    {
        //verificamos q existe el pedido seleccionad
        $id_pedido = $request->id_pedido;
        $pedido = Pedido::find($id_pedido);
        if ($pedido == null) {

           return back()->with('alert-type','error')->with('status','No seleccionaste el número de Proveedor');
        }
         //GUARDAMOS LA FACTURA
        FacturaProveedor::create($request->validated());
       
        //LE ASIGNAMOS LA FACTURA AL PEDIDO
        $facturaCreada = FacturaProveedor::where('nro_factura_proveedor','=',$request->nro_factura_proveedor)->first();
        $id_factura_proveedor = $facturaCreada->id;
        $pedido->factura_proveedor_id = $id_factura_proveedor;
        //$pedido->estado = 2;
        $pedido->saldo = $request->monto_factura;
        
        $pedido->save();

        return  //redirect()->route('pedidos.show', [$pedido->id])->with('alert-type','success')->with('status','Factura asignada con exito');
                redirect()->action('PedidoController@index')->with('alert-type','success')->with('status','Factura asignada con exito');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function show($id)
    {
        
         $pedido=Pedido::with('planta')->where('id','=',$id)->first();
         
         return $pedido;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * ASIGNAR VEHICULO/TRANSPORTISTA A PEDIDO
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(StoreTransportistaPedidoRequest $request, $id)
    {
        //return $request;
        $pedido = Pedido::findOrFail($id)->update($request->validated());
       //Cliente::findOrFail($id)->update($request->validated());
        //$pedido->vehiculo_id = $request->placa;
       // $pedido->save();

      return  back()->with('alert-type','success')->with('status','Transportista asignado con exito');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
