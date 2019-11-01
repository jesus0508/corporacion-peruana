<?php

namespace CorporacionPeru\Http\Controllers;

use Illuminate\Http\Request;
use CorporacionPeru\Egreso;
use CorporacionPeru\Grifo;
use CorporacionPeru\IngresoGrifo;
use Carbon\Carbon;
use DB;

class GananciaNetaGrifoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $egresos = Egreso::join('concepto_gastos','concepto_gastos.id','=','egresos.concepto_gasto_id')
                    ->join('sub_categoria_gastos','sub_categoria_gastos.id','=','concepto_gastos.sub_categoria_gasto_id')
                    ->join('categoria_gastos','categoria_gastos.id','=','sub_categoria_gastos.categoria_gasto_id')
                    ->join('grifos','grifos.id','=','egresos.grifo_id')

                    ->select(DB::raw('DATE(fecha_egreso) as day'), 'grifos.razon_social as grifo',
                        DB::raw('-1*(monto_egreso) as monto') , 'concepto_gastos.concepto as detalle'
                            );
                  

            $ingresos_egresos = IngresoGrifo::join('grifos','grifos.id','=','ingreso_grifos.grifo_id')
                    ->select('ingreso_grifos.fecha_ingreso as day','grifos.razon_social as grifo',
                     'ingreso_grifos.monto_ingreso as monto' , 'ingreso_grifos.id as detalle')
                    ->union($egresos)
                    ->get();
                    //return $ingresos_egresos;

        $grifos         = Grifo::all();
        $semana = config('constants.semana_name');
        $semana = config('constants.semana_name');
        $today = $semana[strftime( '%w',strtotime('now') )];
        $today_date = strftime( '%d/%m/%Y',strtotime('now') );
        $yesterday = $semana[strftime( '%w',strtotime('-1 day') )];
        $yesterday_date = strftime( '%d/%m/%Y',strtotime('-1 day') );

        return view('reporte_ganancia_grifo.reporte_detallado.index',compact('ingresos_egresos','grifos','today','yesterday','today_date','yesterday_date'));
    }

}
