<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Exports\MovimientoExport;
use CorporacionPeru\Movimiento;
use CorporacionPeru\PagoCliente;
use Illuminate\Http\Request;
use CorporacionPeru\Http\Requests\StoreMovimientoRequest;
use Carbon\Carbon;

class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $today = strftime( '%d/%m/%Y',strtotime('now') );
        return view('movimientos.index', compact('today'));
    }

    /**
     * Datos Movimientos entre fechas..
     * @param  [date] $dateInicio [fecha de inico]
     * @param  [date] $dateFin [fecha de  final]
     * @return [json]       [formato para datatables]
     */
    public function movimientosDataBetween($dateInicio = null,$dateFin=null){

        if ( $dateInicio == null ) {
            $dateInicio = Carbon::now()->format('Y-m-d');
        }
        if ( $dateFin == null ) {
            $dateFin = Carbon::now()->format('Y-m-d');
        }

        $movimientos = Movimiento::whereBetween('fecha_reporte',[$dateInicio,$dateFin])
                ->select('movimientos.*','fecha_reporte as fecha_ingreso')
                ->get(); 
        return datatables()->of($movimientos)
            ->addColumn('action', 'movimientos.action')->make(true);
    }

   
    /**
     * Datos Movimientos para ..
     * @param  [date] $date [fecha]
     * @return [json]       [formato para datatables]
     */
    public function movimientosModifyData($date=null){

        if ( $date == null ) {
            $date = Carbon::now()->format('Y-m-d');
        }
        $movimientos = Movimiento::where('fecha_reporte',$date)->get();
        return response()->json(['data' => $movimientos]);
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
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\MovimientoGrifo  $movimientoGrifo
     * @return \Illuminate\Http\Response
     */
    public function edit(Movimiento $movimiento)
    {
        return response()->json(['movimiento'=>$movimiento]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Movimiento  $movimiento
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMovimientoRequest $request)
    {
        $id = $request->id;       
        Movimiento::findOrFail($id)->update($request->validated());
        return 
        back()->with('alert-type','success')->with('status','Movimiento actualizado con exito');  
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
