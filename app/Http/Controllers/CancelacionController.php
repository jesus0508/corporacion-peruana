<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Cancelacion;
use Illuminate\Http\Request;
use CorporacionPeru\Grifo;
use CorporacionPeru\FacturacionGrifo;
use CorporacionPeru\Http\Requests\StoreCancelacionRequest;

class CancelacionController extends Controller
{
    /**
     * Display a listing of the resource.
     * Redirije a 'Lista Cancelación Grifo' 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grifos = Grifo::all();
        $facturacion_grifos = FacturacionGrifo::leftJoin('cancelacions',
            'cancelacions.facturacion_grifo_id','facturacion_grifos.id')->get();

        return view('factura_grifos.cancelaciones.diario.index',compact('grifos', 'facturacion_grifos'));
    }
    /**
     * Busca cancelaciones de una facturación grifo, con $id y $fecha
     * @param  int $id       id del grifo
     * @param  string $fecha fecha de la facturación grifo
     * @return [array]        [FacturacionGrifo objeto]
     */
    public function cancelacion_search( $id, $fecha ){//id: id del grifo

        $ingreso_grifo ='';
        if ($id AND $fecha) {
            $ingreso_grifo=FacturacionGrifo::with('cancelaciones')->where('grifo_id','=',$id)->where('fecha_facturacion',$fecha)->first();   
        }            
         
         return $ingreso_grifo;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grifos = Grifo::all();
        $cancelaciones = Cancelacion::all()->take(100);

        return view('factura_grifos.cancelaciones.index',compact('grifos', 'cancelaciones'));
    }

    /**
     * Almacenar cancelación y verificando si el monto supera el 
     * saldo de FacturacionGrifo
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCancelacionRequest $request)
    {   
        //validar monto ingreso
        $id_facturacion_grifo = $request->facturacion_grifo_id;
        $facturacion_grifo = FacturacionGrifo::findOrFail($id_facturacion_grifo);
        $pagado=0;
        foreach ($facturacion_grifo->cancelaciones as $cancelacion) {
            $pagado += $cancelacion->monto;
        }
        $monto_total = $facturacion_grifo->getMontoTotal();
        $saldo = $monto_total-$pagado;
        if ($request->monto > $saldo) {
            $exceso = $request->monto -$saldo;
            return back()->with('alert-type', 'warning')
                ->with('status', 'Cancelación excede en '.$exceso.' el monto total. No Registrado');
        }
        Cancelacion::create($request->validated());
        return back()->with('alert-type', 'success')->with('status', 'Cancelación Registrada con éxito');
    }

    public function modify(){
        $cancelaciones = Cancelacion::all();
        return view('factura_grifos.cancelaciones.modify.index',compact('cancelaciones'));
    }
 
    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Cancelacion  $cancelacion
     * @return \Illuminate\Http\Response
     */
    public function show(Cancelacion $cancelacion)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\Cancelacion  $cancelacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Cancelacion $cancelacion)
    {
        return response()->json(['cancelacion' => $cancelacion ]);      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Cancelacion  $cancelacion
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCancelacionRequest $request)
    {
        $cancelacion = Cancelacion::findOrFail($request->id);
        $cancelacion->update($request->validated());

        return back()->with('alert-type', 'success')->with('status', 'Cancelación Actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\Cancelacion  $cancelacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cancelacion $cancelacion)
    {
        //
    }
}
