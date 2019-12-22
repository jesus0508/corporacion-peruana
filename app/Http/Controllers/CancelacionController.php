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
     *
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
     * [cancelacion_search description]
     * @return [type] [description]
     */
    public function cancelacion_search( $id, $fecha ){//id: id del grifo

        $ingreso_grifo=FacturacionGrifo::with('cancelaciones')->where('grifo_id','=',$id)->where('fecha_facturacion',$fecha)->first();       
         
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCancelacionRequest $request)
    {   $validado = $request->validated();//input validar
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

        $cancelaciones =Cancelacion::create($validado);
        $cancelaciones->setFechaCancelacionAttribute($request->fecha);
        $cancelaciones->save();

        return back()->with('alert-type', 'success')->with('status', 'Cancelación Registrada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Cancelacion  $cancelacion
     * @return \Illuminate\Http\Response
     */
    public function show(Cancelacion $cancelacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\Cancelacion  $cancelacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Cancelacion $cancelacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Cancelacion  $cancelacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cancelacion $cancelacion)
    {
        //
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
