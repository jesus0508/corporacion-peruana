<?php

namespace CorporacionPeru\Http\Controllers;

use Illuminate\Http\Request;
use CorporacionPeru\IngresoTransporte;
use CorporacionPeru\EgresoTransporte;
use CorporacionPeru\Transporte;
use DB;

class TransporteReporteController extends Controller
{
    /**
     * Reporte Ingreso Neto Unidades Diario
     * @return [type] []
     */
    public function reporteDiarioUnidades(){
        //unidades=2
        $transportes = Transporte::where('tipo','=',2)->get();
        $ingresos = IngresoTransporte::all();//todos son unidades(2)
        $egresos = EgresoTransporte::with(['transporte' => function ($query) {
            $query->where('tipo', '=', 2);
        }])->orderBy('fecha_reporte', 'desc')->get();
       return view('transporte.reporte.unidades.diario.index',
            compact('transportes','ingresos','egresos'));
    }

    /**
     * Reporte Ingreso Neto Unidades Mensual
     * @return [type] []
     */
    public function reporteMensualUnidades(){
		
		$egresos = EgresoTransporte::join('transportes',
                    'transportes.id','=','egreso_transportes.transporte_id')
                    ->where('transportes.tipo','=',2)
                    ->select(
                        DB::raw('-1*(sum(monto_egreso)) as monto'),
                            'egreso_transportes.fecha_reporte',
                            'transportes.placa', 'fecha_reporte as day'
                            )
                    ->groupBy('fecha_reporte','transportes.id')
                    ->get();
        //    return $egresos;
            
        $ingresos = IngresoTransporte::join('transportes',
                    'transportes.id','=','ingreso_transportes.transporte_id')
                    ->select(
                        DB::raw('(sum(monto_ingreso)) as monto'),
                        'ingreso_transportes.fecha_reporte',
                        'fecha_reporte','transportes.placa',
                        'fecha_reporte as day'
                            )
                    ->groupBy('fecha_reporte','transportes.id')
                    ->get();
        $netos = collect([]); 
            foreach ($ingresos as $ingreso) {
                foreach ($egresos as $egreso ) {
                    if( $ingreso->fecha_reporte == $egreso->fecha_reporte AND
                        $ingreso->transporte_id==$egreso->transporte_id){
                        $consolidado = $egreso->monto + $ingreso->monto;
                        $consolidado = round( $consolidado, 2 );
                        $neto = [   
									'fecha_reporte' => $egreso->fecha_reporte, 
									'placa'         => $egreso->placa,
									'monto_ingreso' => $ingreso->monto,                               
									'monto_egreso'  => $egreso->monto,
									'monto_neto'    => $consolidado,
									'day'			=> $ingreso->day
                                ];    
                        $neto = (object)$neto;                  
                        $netos->push($neto);
                    }
                    
                }        
            }

        $transportes         = Transporte::where('tipo','=',2)->get();
        $semana       =  config('constants.semana_name');//constant week                  
        $this_year = strftime( '%Y',strtotime('now') );
        $meses        = config('constants.meses_name');
        $month_actual = $meses[strftime( '%m',strtotime('now') )-1];
        $month_actual_date = $month_actual.' '.$this_year;
        $last_month = $meses[strftime( 
        	'%m',strtotime('first day of -1 month')	)-1];
        $last_month_date = $last_month.' '.$this_year;
	
	return view('transporte.reporte.unidades.mensual.index',
		compact('netos','transportes','month_actual','last_month','semana',
			'month_actual_date','last_month_date'));

    }

    /**
     * Reporte Ingreso Neto Unidades Diario
     * @return [type] []
     */
    public function reporteAnualUnidades(){
		
		$egresos = EgresoTransporte::join('transportes',
                    'transportes.id','=','egreso_transportes.transporte_id')
                    ->where('transportes.tipo','=',2)
                    ->select(DB::raw('MONTH(fecha_reporte) as month'),
                        DB::raw('-1*(sum(monto_egreso)) as monto'),
                        DB::raw('DATE(fecha_reporte) as day'),
                            'transportes.placa'
                            )
                    ->groupBy('month','placa')
                    ->get();
        //   return $egresos;
            
        $ingresos = IngresoTransporte::join('transportes',
                    'transportes.id','=','ingreso_transportes.transporte_id')
                    ->select(DB::raw('MONTH(fecha_reporte) as month'),
                        DB::raw('(sum(monto_ingreso)) as monto'),
                        DB::raw('DATE(fecha_reporte) as day'),
                        'transportes.placa'
                            )
                    ->groupBy('month','placa')
                    ->get();
        //return $ingresos;
            $netos = collect([]); 
            foreach ($ingresos as $ingreso) {
                foreach ($egresos as $egreso ) {
                    if( $ingreso->month == $egreso->month AND
                        $ingreso->placa==$egreso->placa){
                        $consolidado = $egreso->monto + $ingreso->monto;
                        $consolidado = round( $consolidado, 2 );
                        $neto = [   
									'month'         => $egreso->month,
									'day'  			=> $egreso->day,
									'placa'         => $egreso->placa,
									'monto_ingreso' =>$ingreso->monto, 
									'monto_egreso'  =>$egreso->monto,
									'monto_neto'    => $consolidado 
                                ];    
                        $neto = (object)$neto;                  
                        $netos->push($neto);
                    }
                    
                }
                
            }
        $transportes         = Transporte::where('tipo','=',2)->get();
        $semana       =  config('constants.semana_name');//constant week                  
        $this_year = strftime( '%Y',strtotime('now') );
        $meses        = config('constants.meses_name');
        $month_actual = $meses[strftime( '%m',strtotime('now') )-1];
        $month_actual_date = $month_actual.' '.$this_year;
        $last_month = $meses[strftime( '%m',strtotime(
        			'first day of -1 month') )    -1];
        $last_month_date = $last_month.' '.$this_year;

        return view('transporte.reporte.unidades.anual.index',
        	compact('netos','transportes','month_actual','last_month',
        		'semana','month_actual_date','last_month_date'));
  

    }

    /**
     * Reporte Ingreso Neto Diario
     * @return [type] [view]
     */
    public function reporteDiarioTotal(){
        $transportes = Transporte::all();
        $ingresos = IngresoTransporte::all();//todos son unidades(2)
        $egresos = EgresoTransporte::with('transporte')->orderBy('fecha_reporte', 'desc')->get();
      
    return view('transporte.reporte.todos.diario.index',
            compact('transportes','ingresos','egresos'));
    }

    /**
     * Reporte Ingreso Neto  Mensual
     * @return [type] []
     */
    public function reporteMensualTotal(){
        $transportes = Transporte::all();
        $egresos = Transporte::join('egreso_transportes',
                    'transportes.id','=','egreso_transportes.transporte_id')
                    ->select(
                        DB::raw('-1*(sum(monto_egreso)) as monto'),
                            'egreso_transportes.fecha_reporte',
                            'transportes.placa', 'transportes.tipo',
                             'fecha_reporte as day'
                            )
                    ->groupBy('fecha_reporte','transportes.placa')
                    ->get();
        $ingresos = Transporte::join('ingreso_transportes',
                    'transportes.id','=','ingreso_transportes.transporte_id')
                    ->select(
                        DB::raw('(sum(monto_ingreso)) as monto'),
                        'ingreso_transportes.fecha_reporte',
                        'fecha_reporte','transportes.placa',
                        'transportes.tipo',
                        'fecha_reporte as day'
                            )
                    ->groupBy('fecha_reporte','transportes.placa')
                    ->get();

        $semana       =  config('constants.semana_name');//constant week                  
        $this_year = strftime( '%Y',strtotime('now') );
        $meses        = config('constants.meses_name');
        $month_actual = $meses[strftime( '%m',strtotime('now') )-1];
        $month_actual_date = $month_actual.' '.$this_year;
        $last_month = $meses[strftime( 
            '%m',strtotime('first day of -1 month') )-1];
        $last_month_date = $last_month.' '.$this_year;

    return view('transporte.reporte.todos.mensual.index',
            compact('transportes','ingresos','egresos','month_actual',
                'last_month', 'semana',  'month_actual_date','last_month_date'));
    }

  /**
     * Reporte Ingreso Neto Diario
     * @return [type] [view]
     */
    public function reporteAnualTotal(){

        $transportes = Transporte::all();
        $egresos = Transporte::join('egreso_transportes',
                    'transportes.id','=','egreso_transportes.transporte_id')
                    ->select(
                        DB::raw('-1*(sum(monto_egreso)) as monto'),
                            'egreso_transportes.fecha_reporte',
                            'transportes.placa', 'transportes.tipo',
                             'fecha_reporte as day',  DB::raw('MONTH(fecha_reporte) as month')
                            )
                    ->groupBy('month','transportes.placa')
                    ->get();
        $ingresos = Transporte::join('ingreso_transportes',
                    'transportes.id','=','ingreso_transportes.transporte_id')
                    ->select(
                        DB::raw('(sum(monto_ingreso)) as monto'),
                        'ingreso_transportes.fecha_reporte',
                        'fecha_reporte','transportes.placa',
                        'transportes.tipo',
                        'fecha_reporte as day',  DB::raw('MONTH(fecha_reporte) as month')
                            )
                    ->groupBy('month','transportes.placa')
                    ->get();  

    return view('transporte.reporte.todos.anual.index',
            compact('transportes','ingresos','egresos'));

    }
}
