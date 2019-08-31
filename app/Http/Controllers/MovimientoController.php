<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Exports\MovimientoExport;
use CorporacionPeru\Movimiento;
use CorporacionPeru\PagoCliente;
use Illuminate\Http\Request;
use CorporacionPeru\Http\Requests\StoreMovimientoRequest;

class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $movimientos = Movimiento::orderBy('estado', 'asc')->get();
        return view('movimientos.index', compact('movimientos'));
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
    public function store(StoreMovimientoRequest $request)
    {
        //
        $movimiento = Movimiento::create($request->validated());
        $mensaje = $this->validar($movimiento);
        return back()->with(['alert-type' => $mensaje['type'], 'status' => $mensaje['status']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Movimiento  $movimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Movimiento $movimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\Movimiento  $movimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Movimiento $movimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Movimiento  $movimiento
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMovimientoRequest $request, Movimiento $movimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\Movimiento  $movimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movimiento $movimiento)
    {
        //
    }

    public function validarSinRegistrar()
    {
        $movimientos_invalidados = Movimiento::where('estado', '<', 3)->get();
        $pagos = PagoCliente::all();
        foreach ($movimientos_invalidados as $movimiento) {
            $movimiento->estado = 2;
            foreach ($pagos as $pago) {
                if ($pago->codigo_operacion == $movimiento->codigo_operacion) {
                    $movimiento->estado = 3;
                }
                $movimiento->save();
            }
        }
        return back()->with(['alert-type' => 'success', 'status' => 'Verificacion realizada con exito']);
    }

    public function getByEstado($estado = null)
    {
        $movimientos = null;
        if ($estado) {
            $movimientos = Movimiento::where('estado', '<', $estado);
        } else {
            $movimientos = Movimiento::all();
        }
        return response()->json($movimientos, 200);
    }

    public function validar($movimiento)
    {
        $pagos = PagoCliente::all();
        $mensaje = [
            'type' => 'warning',
            'status' => 'Ninguna coincidencia en pagos para este movimiento' 
        ];
        foreach ($pagos as $pago) {
            if ($pago->codigo_operacion == $movimiento->codigo_operacion) {
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

    public function exportToExcel()
    {
        $movimiento_export = new MovimientoExport;
        return $movimiento_export->download('movimientos.xlsx');
    }
}
