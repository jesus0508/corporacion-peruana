<?php

namespace CorporacionPeru\Http\Controllers;

use Illuminate\Http\Request;
use CorporacionPeru\Pedido;
use CorporacionPeru\Planta;
use CorporacionPeru\Vehiculo;
use CorporacionPeru\FacturaProveedor;
use CorporacionPeru\Http\Requests\StoreFacturaProveedorRequest;
use CorporacionPeru\Http\Requests\StoreTransportistaPedidoRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        $pedidos = Pedido::where('estado','=',2)->whereNull('factura_proveedor_id')->orWhere('estado','=', 3)->whereNull('factura_proveedor_id')->get();
        return view( 'facturas.index',compact(  'pedidos' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFacturaProveedorRequest $request)
    {

        DB::beginTransaction();
        try {       

            $id_pedido = $request->id_pedido;
            $pedido = Pedido::find($id_pedido);
            if ($pedido == null) {
               back()->with('alert-type','error')->with('status','No seleccionaste el número de pedido');
            }
            $factura =FacturaProveedor::create( $request->validated() );   
            $pedido->factura_proveedor_id = $factura->id;
            $pedido->saldo = $request->monto_factura;            
            $pedido->save();
            DB::commit();
        return redirect()->action('PedidoController@index')->with('alert-type','success')->with('status','Factura asignada con exito');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('alert-type','error')->with('status','Ocurrió un error en el proceso');
        }

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

        $pedido = Pedido::findOrFail($id)->update($request->validated());

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
