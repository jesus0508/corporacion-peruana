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
     * INGRESO NETO DIARIO 
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
                    ->select('ingreso_grifos.fecha_ingreso as day',
                        'grifos.zona','ingreso_grifos.fecha_reporte',
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
                                    'fecha_reporte' => $ingreso->fecha_reporte,
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
        $semana = config('constants.semana_name');
        $today = $semana[strftime( '%w',strtotime('now') )];
        $today_date = strftime( '%d/%m/%Y',strtotime('now') );
        $yesterday = $semana[strftime( '%w',strtotime('-1 day') )];
        $yesterday_date = strftime( '%d/%m/%Y',strtotime('-1 day') );

        return view('reporte_ganancia_grifo.reporte_zona.diario.index',compact('netos','zonas','grifos','today','yesterday','today_date','yesterday_date'));
    }


    /**
     * INGRESO NETO MENSUAL
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {      
        $egresos = Egreso::join('concepto_gastos','concepto_gastos.id','=','egresos.concepto_gasto_id')
                    ->join('sub_categoria_gastos','sub_categoria_gastos.id','=','concepto_gastos.sub_categoria_gasto_id')
                    ->join('categoria_gastos','categoria_gastos.id','=','sub_categoria_gastos.categoria_gasto_id')
                    ->join('grifos','grifos.id','=','egresos.grifo_id')
                    ->select(DB::raw('DATE(fecha_egreso) as day'),
                        DB::raw('MONTH(fecha_egreso) as month'), 'grifos.zona',
                        DB::raw('-1*(sum(monto_egreso)) as monto')
                            )
                    ->groupBy('grifos.zona' , 'month')
                    ->get();


            $ingresos = IngresoGrifo::join('grifos','grifos.id','=','ingreso_grifos.grifo_id')
                    ->select('ingreso_grifos.fecha_ingreso as day',
                        DB::raw('MONTH(fecha_ingreso) as month'),'grifos.zona',
                        DB::raw('sum(monto_ingreso) as monto') )
                    ->groupBy('grifos.zona','month')
                    ->get();

            $netos = collect([]); 
            foreach ($ingresos as $ingreso) {
                foreach ($egresos as $egreso ) {
                    if( $ingreso->month == $egreso->month AND $ingreso->zona==$egreso->zona){
                        $consolidado = $egreso->monto + $ingreso->monto;
                        $consolidado = round( $consolidado, 2 );
                        $neto =[    'month'   => $egreso->month, 
                                    'zona' => $egreso->zona,
                                    'day' => $egreso->day,
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
        $semana = config('constants.semana_name');
        $this_year = strftime( '%Y',strtotime('now') );
        $meses        = config('constants.meses_name');
        $month_actual = $meses[strftime( '%m',strtotime('now') )-1];
        $month_actual_date = $month_actual.' '.$this_year;
        $last_month = $meses[strftime( '%m',strtotime('first day of -1 month') )-1];
        $last_month_date = $last_month.' '.$this_year;

        return view('reporte_ganancia_grifo.reporte_zona.mensual.index',compact('netos','zonas','grifos','month_actual','last_month','month_actual_date','last_month_date'));
    }

    
}
