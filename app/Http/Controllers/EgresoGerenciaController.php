<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\EgresoGerencia;
use Illuminate\Http\Request;
use CorporacionPeru\CategoriaEgreso;
use CorporacionPeru\Salida;
use CorporacionPeru\Http\Requests\StoreSalidaRequest;
use Illuminate\Support\Facades\Session;

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

    public function storePagoEgreso(StoreSalidaRequest $request){

        //transaction
        $salida = Salida::create($request->validated());
        Session::flash('alert-type', 'success');
        Session::flash('status', 'Pago de gastos registrado con éxito');
        $egresos = EgresoGerencia::whereIn('id',$request->gastos)
            ->get();           
        $monto_pago= $request->monto_egreso;
        $suma_total = 0;
        $dinero_stock = $monto_pago;//1600
        foreach ($egresos as $egreso) {
            if ($dinero_stock <= 0) {
                break;
            }
            $restanteXpagar = $egreso->saldo;//1500
                //dinero x pagar >=Dinero en stock 
            if( $restanteXpagar >= $dinero_stock ){
                $egreso->saldo -=  $dinero_stock;
                $asignacion = $dinero_stock;
                $egreso->estado = 2; // amortizado
                if ($restanteXpagar==$dinero_stock) {
                    $egreso->estado=3;//pagado
                }                     
                $dinero_stock = 0;
                $egreso->pagoGastos()->attach($salida->id,
                                    ['asignacion'=> $asignacion]);
                $egreso->save();
                //asignacion and save
                break; 

                } else{//si el stockDinero es mayor a lo q se va distribuir
                    if ($egreso->saldo>0) {
                        $dinero_stock -= $egreso->saldo;//    = 1600 -1500;
                        $asignacion = $egreso->saldo; 
                        $egreso->saldo = 0;                  
                        $egreso->estado = 3;//isPaid
                        $egreso->pagoGastos()->attach($salida->id,
                                    ['asignacion'=> $asignacion]);
                        $egreso->save();
                    }                         
                }
            }

        return redirect()->route('egreso_gerencia.index');       
    }

    /**
     * [showGastosPago description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function showGastosPago(Request $request){
        $pago = $request;
        $categoria = CategoriaEgreso::findOrFail(2);//egreso gerencia
        $egresos = EgresoGerencia::whereIn('estado',[1,2])//sin pagar o amortizado
            ->orderBy('fecha')
            ->get();     
        $monto_pago   = $request->monto_pago;
        $suma_total   = 0;
        $egresos_pago = collect([]);
        $dinero_stock = $monto_pago;//1500
        foreach ($egresos as $egreso) {
            if ($dinero_stock <= 0) {
                break;
            }
            $restanteXpagar = $egreso->saldo;//900
                //dinero x pagar >=Dinero en stock 
            if( $restanteXpagar >= $dinero_stock ){//900>=1500

                $asignacion = $dinero_stock;
                $egreso_temporal = [
                    'id'         => $egreso->id ,
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
                $dinero_stock = 0;
                break; 

                } else{//si el stockDinero es mayor a lo q se va distribuir
                    if ($egreso->saldo>0) {
                        $dinero_stock -= $egreso->saldo;//    = 1500 -900;
                        $asignacion = $egreso->saldo;
                        $egreso_temporal = [
                            'id'         => $egreso->id ,
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
                    }                         
                }
            }
        return view('empresa.egresos_gerencia.pago.index',compact('egresos_pago','pago','categoria'));
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
