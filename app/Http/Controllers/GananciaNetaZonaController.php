<?php

namespace CorporacionPeru\Http\Controllers;

use Illuminate\Http\Request;
use CorporacionPeru\Egreso;
use CorporacionPeru\Grifo;
use CorporacionPeru\IngresoGrifo;
use Carbon\Carbon;
use DB;

class GananciaNetaZonaController extends Controller
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
                    ->select(DB::raw('DATE(fecha_egreso) as day'), 'grifos.zona',
                        DB::raw('-1*(sum(monto_egreso)) as monto')
                            )
                    ->groupBy('grifos.zona' , 'day')
                    ->get();

            $ingresos = IngresoGrifo::join('grifos','grifos.id','=','ingreso_grifos.grifo_id')
                    ->select('ingreso_grifos.fecha_ingreso as day','grifos.zona',
                     DB::raw('sum(monto_ingreso) as monto') )
                    ->groupBy('grifos.zona','day')
                    ->get();

            $netos = collect([]); 
            foreach ($ingresos as $ingreso) {
                foreach ($egresos as $egreso ) {
                    if( $ingreso->day == $egreso->day AND $ingreso->zona==$egreso->zona){
                        $consolidado = $egreso->monto + $ingreso->monto;
                        $consolidado = round( $consolidado, 2 );
                        $neto =[    'day'   => $egreso->day, 
                                    'zona' => $egreso->zona,
                                    'monto_ingreso' =>$ingreso->monto,                                 
                                    'monto_egreso' =>$egreso->monto,
                                    'monto_neto' => $consolidado ];    
                        $neto = (object)$neto;                  
                        $netos->push($neto);
                    }
                    
                }
                
            }
        $zonas = config('constants.zonas');
        //return $zonas;
        $grifos         = Grifo::all();
        $date           = Carbon::now();
        $date_yesterday = Carbon::yesterday();
        $semana = config('constants.semana_name');
        $today = $semana[strftime( '%w',strtotime($date) )];
        $yesterday = $semana[strftime( '%w',strtotime($date_yesterday) )];
        return view('reporte_ganancia_grifo.reporte_zona.index',compact('netos','zonas','grifos','today','yesterday'));
    }



    
}
