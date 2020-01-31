<?php

namespace CorporacionPeru\Traits;

use CorporacionPeru\Egreso;
use CorporacionPeru\Grifo;
use CorporacionPeru\IngresoGrifo;
use Carbon\Carbon;
use DB;

trait ReporteIngresosGrifos{

	/**
	 * [Ingresos Diario Grifos Rporte ]
	 * @param  [date] $date Día de ingreso format(Y-m-d)
	 * @return [collection]       [ingresos Dia]
	 */
	public function ingresosGrifosNetoDiario($date){

            $egresos = Egreso::with('grifo:id,razon_social')
                    ->select(
                    	'fecha_egreso','grifo_id',
                    	DB::raw('-1*(sum(monto_egreso)) as monto')
                            )
                    ->where('fecha_egreso',$date)
                    ->groupBy('grifo_id','fecha_egreso')
                    ->get();

            $ingresos = IngresoGrifo::with('grifo:id,razon_social')
                    ->select('fecha_ingreso','grifo_id',
                     	DB::raw('sum(monto_ingreso) as monto') )
                    ->groupBy('grifo_id','fecha_ingreso')
                    ->get();

            $netos = collect([]); 
            foreach ($ingresos as $ingreso) {
                foreach ($egresos as $egreso ) {
                    if( $ingreso->fecha_ingreso == $egreso->fecha_egreso
                    		 AND $ingreso->grifo->id==$egreso->grifo->id){
                        $consolidado = $egreso->monto + $ingreso->monto;
                        $consolidado = round( $consolidado, 2 );
                        $neto =[    
								'fecha_ingreso' => $egreso->fecha_egreso,
								'grifo'         => $egreso->grifo->razon_social,
								'monto_ingreso' => $ingreso->monto,                             
								'monto_egreso'  => $egreso->monto,
								'monto_neto'    => $consolidado 
                            ];   
                        $neto = (object)$neto;                  
                        $netos->push($neto);
                    }
                    
                }
                
            }

         return $netos;
    }


    public function ingresosGrifosNetoMensual($date){

        list($numero_mes, $year) = explode("-", $date);  
        
        $egresos = Egreso::join('grifos','egresos.grifo_id','=','grifos.id')
                ->whereYear('egresos.fecha_egreso',$year)
                ->whereMonth('egresos.fecha_egreso',$numero_mes)                
                ->select( 
                    'egresos.fecha_egreso',
                    DB::raw('-1*(sum(monto_egreso)) as monto'), 
                    'grifos.razon_social as grifo'
                )
                ->groupBy('fecha_egreso','grifo')
                ->get();     

            
        $ingresos = IngresoGrifo::join('grifos','grifos.id','=','ingreso_grifos.grifo_id')
                ->whereYear('ingreso_grifos.fecha_ingreso',$year)
                ->whereMonth('ingreso_grifos.fecha_ingreso',$numero_mes)               
                ->select( 
                	'ingreso_grifos.fecha_ingreso',
                    DB::raw('sum(monto_ingreso) as monto'), 
                    'grifos.razon_social as grifo')
                ->groupBy('fecha_ingreso','grifo')
                ->get();
          
            $netos = collect([]); 
            foreach ($ingresos as $ingreso) {
                foreach ($egresos as $egreso ) {
                    if( $ingreso->fecha_ingreso == $egreso->fecha_egreso 
                    	AND $ingreso->grifo==$egreso->grifo){
                        $consolidado = $egreso->monto + $ingreso->monto;
                        $consolidado = round( $consolidado, 2 );
                        $neto =[
                                    'fecha_ingreso' => $egreso->fecha_egreso, 
                                    'grifo'         => $egreso->grifo,
                                    'monto_ingreso' => $ingreso->monto,                        
                                    'monto_egreso'  => $egreso->monto,
                                    'monto_neto'    => $consolidado ];    
                        $neto = (object)$neto;                  
                        $netos->push($neto);
                    }
                    
                }
                
            }
        return $netos;
    }

    /**
     * Ingreso  Grifo Neto Anual
     * @param [type] $year [description]
     */
    public function ingresosGrifoNetoAnual($year){

    	$egresos  = Egreso::join('grifos','grifos.id','=','egresos.grifo_id')
            ->whereYear('fecha_egreso',$year)
            ->select(             
                DB::raw('YEAR(fecha_egreso) as year'),
                DB::raw('-1*(sum(monto_egreso)) as monto'),
                'grifos.razon_social as grifo'
                )
                ->groupBy('grifo')
                ->get();

        $ingresos = IngresoGrifo::join('grifos','grifos.id','=','ingreso_grifos.grifo_id')
                ->whereYear('ingreso_grifos.fecha_ingreso',$year)             
                ->select( 
                    DB::raw('YEAR(fecha_ingreso) as year'),
                    DB::raw('sum(monto_ingreso) as monto'),
                    'grifos.razon_social as grifo'
                    )
                ->groupBy('grifo')
                ->get();
          
            $netos = collect([]); 
            foreach ($ingresos as $ingreso) {
                foreach ($egresos as $egreso ) {
                    if($ingreso->grifo==$egreso->grifo){
                        $consolidado = $egreso->monto + $ingreso->monto;
                        $consolidado = round( $consolidado, 2 );
                        $neto =[    
                                    'grifo' => $egreso->grifo,
                                    'monto_neto' => $consolidado 
                                ];    
                        $neto = (object)$neto;                  
                        $netos->push($neto);
                    }
                    
                }
                
            }
        return $netos;
    }
}