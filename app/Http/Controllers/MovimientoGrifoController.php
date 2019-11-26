<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\MovimientoGrifo;
use Illuminate\Http\Request;
use CorporacionPeru\Http\Requests\StoreMovimientoGrifoRequest;
use CorporacionPeru\Cancelacion;

class MovimientoGrifoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $movimientos = MovimientoGrifo::orderBy('estado', 'asc')->get();
        return view('factura_grifos.movimientos.index', compact('movimientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMovimientoGrifoRequest $request)
    {
        $movimiento = MovimientoGrifo::create($request->validated());
        $mensaje = $this->verificar($movimiento);
        return back()->with(['alert-type' => $mensaje['type'], 'status' => $mensaje['status']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\MovimientoGrifo  $movimientoGrifo
     * @return \Illuminate\Http\Response
     */
    public function show(MovimientoGrifo $movimientoGrifo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\MovimientoGrifo  $movimientoGrifo
     * @return \Illuminate\Http\Response
     */
    public function edit(MovimientoGrifo $movimientoGrifo)
    {
        //
    }

    /**
     * Verifica si existe la cancelación, si existe cambia a conforme
     * @param  [MovimientoGrifo] $movimiento [description]
     * @return [type]             [description]
     */
        public function verificar($movimiento)
    {
        $pagos = Cancelacion::all();//cancealaciones grifos
        $mensaje = [
            'type' => 'warning',
            'status' => 'Ninguna coincidencia en cancelaciones para este movimiento' 
        ];
        foreach ($pagos as $pago) {
            if ($pago->nro_operacion == $movimiento->codigo_operacion) {
                $movimiento->estado = 3;
                $movimiento->save();
                $mensaje['type']='success';
                $mensaje['status']='Movimiento validado con exito';
                return $mensaje;
            }
        }
        $movimiento->estado = 2;
        $movimiento->save();
        return $mensaje;
    }

    public function verificarSinRegistrar()
    {
        $movimientos_sin_verificar = MovimientoGrifo::where('estado', '<', 3)->get();
        $pagos = Cancelacion::all();//cancelaciones
        foreach ($movimientos_sin_verificar as $movimiento) {
            $movimiento->estado = 2;
            foreach ($pagos as $pago) {
                if ($pago->nro_operacion == $movimiento->codigo_operacion) {
                    $movimiento->estado = 3;
                }
                $movimiento->save();
            }
        }
        return back()->with(['alert-type' => 'success', 'status' => 'Verificacion realizada con exito']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\MovimientoGrifo  $movimientoGrifo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MovimientoGrifo $movimientoGrifo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\MovimientoGrifo  $movimientoGrifo
     * @return \Illuminate\Http\Response
     */
    public function destroy(MovimientoGrifo $movimientoGrifo)
    {
        //
    }
}
