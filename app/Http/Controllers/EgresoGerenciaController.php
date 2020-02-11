<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\EgresoGerencia;
use Illuminate\Http\Request;

class EgresoGerenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $egresos = EgresoGerencia::all();
        //return $egresos;
        return view('empresa.egresos_gerencia.index',compact('egresos'));
    }

    public function showGastosPago(Request $request){
        $pago = $request;
        //return $pago;
        $egresos = EgresoGerencia::where('estado',1)
            ->orWhere('estado',2)
            ->orderBy('fecha')
            ->get();
        $monto_pago= $request->monto_pago;
        $suma_total = 0;
        $egresos_pago = collect([]);
        $dinero_stock = $monto_pago;//1600
        foreach ($egresos as $egreso) {
            if ($dinero_stock <= 0) {
                break;
            }
            $restanteXpagar = $egreso->monto;//1500

                //dinero x pagar >=Dinero en stock 
            if( $restanteXpagar >= $dinero_stock ){
                $egreso->saldo -=  $dinero_stock;
                $saldo = $egreso->saldo;
                $asignacion = $dinero_stock;
                $egreso_temporal = [
                    'fecha'      => $egreso->fecha ,
                    'nombre'     => $egreso->getNombre(),
                    'concepto'   => $egreso->concepto,
                    'tipo'       => $egreso->getTipoComprobante(),
                    'estado'     => $egreso->getEstado(),
                    'monto'      => $egreso->monto,
                    'saldo'      => $egreso->saldo,
                    'asignacion' => $asignacion
                ];
                $egreso_temporal = (object)$egreso_temporal; 
                $egresos_pago->push($egreso_temporal);
                // $pedido->estado = 4; // amortizado
                // if ($restanteXasignar==$dinero_stock) {
                //     $pedido->estado=5;//pagado
                // }                     
                $dinero_stock = 0;
                //asignacion and save
                break; 

                } else{//si el stockDinero es mayor a lo q se va distribuir
                    if ($egreso->saldo>0) {
                        $dinero_stock -= $egreso->saldo;//    = 1600 -1500;
                        $asignacion = $egreso->saldo;
                        $egreso_temporal = [
                            'fecha'      => $egreso->fecha ,
                            'nombre'     => $egreso->getNombre(),
                            'concepto'   => $egreso->concepto,
                            'tipo'       => $egreso->getTipoComprobante(),
                            'estado'     => $egreso->getEstado(),
                            'monto'      => $egreso->monto,
                            'saldo'      => $egreso->saldo,
                            'asignacion' =>$asignacion
                        ];
                        $egreso_temporal = (object)$egreso_temporal; 
                        $egresos_pago->push($egreso_temporal);
                        // $egreso->estado = 5;//isPaid
                            //se le asigna el pedido proveedor al  pago
                        //asignacion and save
                        // $dinero_stock;
                    }                         
                }
            }
        return view('empresa.egresos_gerencia.pago.index',compact('egresos_pago','pago'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $egreso = EgresoGerencia::create($request->all());
        $egreso->saldo = $egreso->monto;
        $egreso->save();

        return back()->with('alert-type', 'success')->with('status', 'Gasto Gerencia Registrado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\EgresoGerencia  $egresoGerencia
     * @return \Illuminate\Http\Response
     */
    public function show(EgresoGerencia $egresoGerencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\EgresoGerencia  $egresoGerencia
     * @return \Illuminate\Http\Response
     */
    public function edit(EgresoGerencia $egresoGerencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\EgresoGerencia  $egresoGerencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EgresoGerencia $egresoGerencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\EgresoGerencia  $egresoGerencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(EgresoGerencia $egresoGerencia)
    {
        //
    }
}
