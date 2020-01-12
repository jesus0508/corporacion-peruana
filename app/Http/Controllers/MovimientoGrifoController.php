<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\MovimientoGrifo;
use Illuminate\Http\Request;
use CorporacionPeru\Http\Requests\StoreMovimientoGrifoRequest;
use CorporacionPeru\Cancelacion;
use CorporacionPeru\Grifo;
use Carbon\Carbon;

class MovimientoGrifoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $today = strftime( '%d/%m/%Y',strtotime('now') );       
        $grifos = Grifo::all();

        return view('factura_grifos.movimientos.index', compact('today','grifos'));
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
     * Datos Movimientos Grifos entre fechas..
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

        $movimientos = MovimientoGrifo::join('grifos','grifos.id','=','movimiento_grifos.grifo_id')
                ->whereBetween('fecha_reporte',[$dateInicio,$dateFin])
                ->select('movimiento_grifos.*','fecha_reporte as fecha_ingreso','grifos.razon_social as grifo')
                ->get(); 
        return datatables()->of($movimientos)
            ->addColumn('action', 'factura_grifos.movimientos.action')->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\MovimientoGrifo  $movimientoGrifo
     * @return \Illuminate\Http\Response
     */
    public function edit(MovimientoGrifo $movimientoGrifo)
    {
        $grifos = Grifo::all();
        return response()->json(['movimientoGrifo'=>$movimientoGrifo,'grifos'=>$grifos]);
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
    public function update(StoreMovimientoGrifoRequest $request)
    {
        $id = $request->id;       
        MovimientoGrifo::findOrFail($id)->update($request->validated());
        return 
        back()->with('alert-type','success')->with('status','Movimiento actualizado con exito');  
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
