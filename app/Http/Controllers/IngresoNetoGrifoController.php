<?php

namespace CorporacionPeru\Http\Controllers;

use Illuminate\Http\Request;
use CorporacionPeru\Egreso;
use CorporacionPeru\Grifo;
use CorporacionPeru\IngresoGrifo;
use Carbon\Carbon;
use DB;

class IngresoNetoGrifoController extends Controller
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
                        DB::raw('-1*(sum(monto_egreso)) as monto')
                            )
                    ->groupBy('egresos.grifo_id' , 'day')
                    ->get();

            $ingresos = IngresoGrifo::join('grifos','grifos.id','=','ingreso_grifos.grifo_id')
                    ->select('ingreso_grifos.fecha_ingreso as day','grifos.razon_social as grifo',
                     'ingreso_grifos.monto_ingreso as monto' )
                    ->get();

            $netos = collect([]); 
            foreach ($ingresos as $ingreso) {
                foreach ($egresos as $egreso ) {
                    if( $ingreso->day == $egreso->day AND $ingreso->grifo==$egreso->grifo){
                        $consolidado = $egreso->monto + $ingreso->monto;
                        $consolidado = round( $consolidado, 2 );
                        $neto =[    'day'   => $egreso->day, 
                                    'grifo' => $egreso->grifo,
                                    'monto_ingreso' =>$ingreso->monto,
                                 
                                    'monto_egreso' =>$egreso->monto,
                                    'monto_neto' => $consolidado ];    
                        $neto = (object)$neto;                  
                        $netos->push($neto);
                    }
                    
                }
                
            }

        $grifos         = Grifo::all();
        $semana = config('constants.semana_name');
        $today = $semana[strftime( '%w',strtotime('now') )];
        $yesterday = $semana[strftime( '%w',strtotime('-1 day') )];       

        return view('reporte_ingresos_grifo_neto.index',compact('netos','grifos','today','yesterday'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $egresos = Egreso::join('concepto_gastos','concepto_gastos.id','=','egresos.concepto_gasto_id')
                    ->join('sub_categoria_gastos','sub_categoria_gastos.id','=','concepto_gastos.sub_categoria_gasto_id')
                    ->join('categoria_gastos','categoria_gastos.id','=','sub_categoria_gastos.categoria_gasto_id')
                    ->join('grifos','grifos.id','=','egresos.grifo_id')

                    ->select(DB::raw('MONTH(fecha_egreso) as month'), 'grifos.razon_social as grifo',
                        DB::raw('-1*(sum(monto_egreso)) as monto'),DB::raw('DAY(fecha_egreso) as day')
                            )
                    ->groupBy('egresos.grifo_id' , 'month')
                    ->get();
            
            $ingresos = IngresoGrifo::join('grifos','grifos.id','=','ingreso_grifos.grifo_id')
                    ->select(DB::raw('MONTH(fecha_ingreso) as month'),'grifos.razon_social as grifo',
                     'ingreso_grifos.monto_ingreso as monto' ,DB::raw('DATE(fecha_ingreso) as day'))
                    ->groupBy('month')
                    ->get();
          
            $netos = collect([]); 
            foreach ($ingresos as $ingreso) {
                foreach ($egresos as $egreso ) {
                    if( $ingreso->month == $egreso->month AND $ingreso->grifo==$egreso->grifo){
                        $consolidado = $egreso->monto + $ingreso->monto;
                        $consolidado = round( $consolidado, 2 );
                        $neto =[    'month'   => $egreso->month, 
                                    'grifo' => $egreso->grifo,
                                    'monto_ingreso' =>$ingreso->monto,
                                    'day' => $ingreso->day,
                                 
                                    'monto_egreso' =>$egreso->monto,
                                    'monto_neto' => $consolidado ];    
                        $neto = (object)$neto;                  
                        $netos->push($neto);
                    }
                    
                }
                
            }
        $grifos         = Grifo::all();
        $semana       =  config('constants.semana_name');//constant week                  
        $this_year = strftime( '%Y',strtotime('now') );
        $meses        = config('constants.meses_name');
        $month_actual = $meses[strftime( '%m',strtotime('now') )-1];
        $month_actual_date = $month_actual.' '.$this_year;
        $last_month = $meses[strftime( '%m',strtotime('first day of -1 month') )-1];
        $last_month_date = $last_month.' '.$this_year;

        return view('reporte_ingresos_grifo_neto.mensual.index',compact('netos','grifos','month_actual','last_month','semana','month_actual_date','last_month_date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
