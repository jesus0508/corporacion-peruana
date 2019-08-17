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
use CorporacionPeru\PedidoCliente;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{

    public function confirmarPedido($id)
    {
        $pedido = Pedido::findOrFail($id);
        /*Logica para actualizar pedido pendiente*/
        $pedido->estado = 2;
        $pedido->save();
        return  back()->with('alert-type', 'success')->with('status', 'Pedido confirmado con exito');
    }

    public function show2($id_proveedor)
    {
        $planta = Planta::findOrFail($id_proveedor);
        $id = $planta->id;
        $pedido = Pedido::where('planta_id', $id)->first();


        return response()->json(['pedido' => $pedido]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pedidos = Pedido::with('planta')->get();
        $plantas = Planta::all();
        return view('pedidosP.index', compact('pedidos', 'plantas'));
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
        return  back()->with('alert-type', 'success')->with('status', 'Pedido creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $pedido = Pedido::with('planta')->with('vehiculo')->with('facturaProveedor')->where('id', '=', $id)->first();

        $transportista_id = $pedido->vehiculo->transportista_id;
        $transportistaCol = Transportista::find($transportista_id);
        $transportista = $transportistaCol->nombre_transportista;

        return view('facturas.show.createDirecto', compact('pedido', 'transportista'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */

    public function distribuir($id)
    {
        $pedido = Pedido::where('id', '=', $id)->with('planta')->first();

        $pedidos_clientes_confirmados
            = PedidoCliente::where('estado', '=', 2)->with('cliente')->orderBy('id', 'desc')->get();
        $pedidos_cl = $pedidos_clientes_confirmados;
        $vehiculos = Vehiculo::all();
        //return $pedidos_cl;
        return view('distribucion.index', compact('pedido', 'pedidos_cl', 'vehiculos'));
    }

    public function ver_distribucion($id)
    {

        $pedido = Pedido::findOrFail($id);
        $pedidos_cl = PedidoCliente::join('pedido_proveedor_clientes', 'pedido_clientes.id', '=', 'pedido_proveedor_clientes.pedido_cliente_id')->join('pedidos', 'pedidos.id', '=', 'pedido_proveedor_clientes.pedido_id')->where('pedido_id', $id)->get();
        // $pedidos_cl =  $pedidos_cl->pedidos->wherePivot('pedido_id','=',$request->pedido_id)->get();
        // $pedidos_cl->where('pivot.pedido_id','=',1);
        // return $pedidos_cl;
        return view('distribucion.resumen.index', compact('pedido', 'pedidos_cl'));
    }

    public function asignar_individual(Request $request)
    {

        $pedido_cl = PedidoCliente::findOrFail($request->id_pedido_cliente);
        $cantDistribuir = $request->galonesXasignar;
        $pedido = Pedido::findOrFail($request->id_pedido_pr);
        $galonaje_stock = $request->galones_stock;

        if (
            $pedido->getGalonesStock() < $request->galones_stock or
            $cantDistribuir > $pedido_cl->galonesXasignar()
        ) {

            return back()->with('alert-type', 'error')->with('status', 'Galonaje incorrecto!');
        }
        $restanteXasignar = $request->galones_pedido_cl;

        if ($restanteXasignar > $galonaje_stock) {

            $pedido_cl->galones_asignados += $galonaje_stock;
            $pedido->galones_distribuidos += $galonaje_stock;
            $pedido->pedidosCliente()->attach($pedido_cl->id);
            $pedido->save();
            $pedido_cl->save();
        } else { //si el stock es mayor a lo q se distribuira

            $pedido_cl->galones_asignados += $restanteXasignar;
            $pedido->galones_distribuidos += $pedido_cl->galones;
            $pedido_cl->estado = 3;
            $pedido->pedidosCliente()->attach($pedido_cl->id);
            $pedido->save();
            $pedido_cl->save();
        }

        $pedidos_cl = PedidoCliente::join('pedido_proveedor_clientes', 'pedido_clientes.id', '=', 'pedido_proveedor_clientes.pedido_cliente_id')->join('pedidos', 'pedidos.id', '=', 'pedido_proveedor_clientes.pedido_id')->where('pedido_id', $request->id_pedido_pr)->get();

        return view('distribucion.resumen.index', compact('pedido', 'pedidos_cl'));
    }




    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */

    public function distribuir_pedido(Request $request)
    {

        try {

            DB::beginTransaction();

            $cantDistribuir = $request->galones_dist;
            $pedido = Pedido::findOrFail($request->pedido_id);
            //    $contador = 1;

            $pedidos_cl = PedidoCliente::where('estado', '=', 2)->with('cliente')->orderBy('galones_asignados', 'asc')->get();
            $galonaje_stock = $cantDistribuir;
            // return $pedidos_cl;
            foreach ($pedidos_cl as $pedido_cl) {
                // 1200 - 1200
                $restanteXasignar = $pedido_cl->galones - $pedido_cl->galones_asignados;
                if (
                    $pedido->getGalonesStock() <= 0 or
                    $galonaje_stock == 0
                ) {

                    break; //sale del foreach

                }
                //galonaje en stock <= galonaje x asignar
                if ($restanteXasignar >= $galonaje_stock) {

                    $cantAsignada = $pedido_cl->galones_asignados + $galonaje_stock;
                    if ($cantAsignada <= $pedido_cl->galones) {

                        $pedido_cl->galones_asignados = $cantAsignada;
                        $pedido->galones_distribuidos += $galonaje_stock;
                        $galonaje_stock = 0;
                        //se le asigna el pedido proveedor al pedido cliente
                        $pedido->pedidosCliente()->attach($pedido_cl->id);
                        // $pedido_cl->pedidos()->attach($pedido_cl->id);
                        $pedido->save();
                        $pedido_cl->save();
                        break;
                    }
                } else { //si el stock es mayor a lo q se distribuira
                    //  + 1200
                    $cantAsignada = $pedido_cl->galones_asignados + $pedido_cl->galones;

                    if ($cantAsignada <= $pedido_cl->galones) {

                        $pedido_cl->galones_asignados = $cantAsignada;
                        $galonaje_stock -= $pedido_cl->galones;
                        $pedido->galones_distribuidos += $pedido_cl->galones;
                        $pedido_cl->estado = 3;
                        // se le asigna el pedido proveedor al pedido cliente
                        // $pedido_cl->pedidos()->attach($pedido_cl->id);
                        $pedido->pedidosCliente()->attach($pedido_cl->id);
                        $pedido->save();
                        $pedido_cl->save();
                    }
                }
                //  $contador++;


            } //FIN FOREACH
            DB::commit();

            $pedidos_cl = PedidoCliente::join('pedido_proveedor_clientes', 'pedido_clientes.id', '=', 'pedido_proveedor_clientes.pedido_cliente_id')->join('pedidos', 'pedidos.id', '=', 'pedido_proveedor_clientes.pedido_id')->where('pedido_id', $request->pedido_id)->get();
            // $pedidos_cl =  $pedidos_cl->pedidos->wherePivot('pedido_id','=',$request->pedido_id)->get();
            // $pedidos_cl->where('pivot.pedido_id','=',1);
            //return $pedidos_cl;
            return view('distribucion.resumen.index', compact('pedido', 'pedidos_cl'));
        } //fin try
        catch (Exception $e) {

            $pedido = Pedido::where('id', '=', $id)->with('planta')->first();

            $pedidos_clientes_confirmados
                = PedidoCliente::where('estado', '=', 2)->with('cliente')->orderBy('galones_asignados', 'asc')->get();
            $pedidos_cl = $pedidos_clientes_confirmados;

            DB::rollback();

            return view('distribucion.index', compact('pedido', 'pedidos_cl'))->with('alert-type', 'error')->with('status', 'Ocurrio un error inesperado!');
        }
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

        return view('facturas.Ind.createDirecto', compact('pedido', 'vehiculos'));
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
        $id = $request->id;
        // return $request;
        Pedido::findOrFail($id)->update($request->validated());

        return  back()->with('alert-type', 'success')->with('status', 'Pedido editado con exito');
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


        return  back()->with('alert-type', 'warning')->with('status', 'Pedido borrado con exito');
    }
}
