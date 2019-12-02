<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\FacturacionGrifo;
use Illuminate\Http\Request;
use CorporacionPeru\Grifo;
use CorporacionPeru\Http\Requests\StoreFacturacionGrifoRequest;


class FacturacionGrifoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grifos = Grifo::all();
        $factura_grifos = FacturacionGrifo::all()->sortByDesc('id');  

        $this_year = strftime( '%Y',strtotime('now') );
        $meses        = config('constants.meses_name');
        $month_actual = $meses[strftime( '%m',strtotime('now') )-1];
        $month_actual_date = $month_actual.' '.$this_year;
        $last_month = $meses[strftime( '%m',strtotime('first day of -1 month') )-1];
        $last_month_date = $last_month.' '.$this_year;

        return view('factura_grifos.index',compact('grifos','factura_grifos','month_actual','last_month','month_actual_date','last_month_date'));
    }

    /**
     * Obtener las series de un grifo 
     * @param  [type] $id [id del grifo]
     * @return [type] [description]
     */
    public function series_grifo($id = -1){
        $series_grifo = '';
        if ($id!=-1) {
            $grifo = Grifo::findOrFail($id);
            $series_grifo = '';
            if ($grifo->series) {
                $series_grifo = '';
               foreach ($grifo->series as $serie) {
                $series_grifo = $series_grifo.' '.$serie->serie;            
                }  
            }          
            return response()->json(['series_grifo' => $series_grifo]);
        }else{
            return response()->json(['series_grifo' => $series_grifo]);
        }
            
    }
    /**
     * Obtener los grifos que no tienen factura, en la fecha $fecha
     * @param  [type] $fecha [fecha ingresada]
     * @return [type]        [description]
     */
    public function getGrifosSinFacturacion( $fecha  = null){
               
        if ($fecha) {
            $grifos = Grifo::join('facturacion_grifos','facturacion_grifos.grifo_id','=','grifos.id')
                        ->whereDate('facturacion_grifos.fecha_facturacion',$fecha)
                        ->select('grifos.id')
                        ->get();
            $grifos_facturados_id = [];
            foreach ($grifos as $grifo) {
                $grifos_facturados_id[] = $grifo->id;
            }
            //return $grifos_facturados_id;
            $grifos = Grifo::select('id', 'razon_social as text')->whereNotIn('id',$grifos_facturados_id)                   
            ->get();
            return response()->json(['grifos' => $grifos]);
        }else{

            $grifos =[];
            return response()->json(['grifos' => $grifos]);
        }
            
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFacturacionGrifoRequest $request)
    {

        $facturacion_grifo = FacturacionGrifo::create($request->validated());
        $facturacion_grifo->setFechaFacturaAttribute($request->fecha_facturacion);
        $facturacion_grifo->save();

        return back()->with(['alert-type' => 'success', 'status' => 'Facturacion Grifo Registrado con exito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\FacturacionGrifo  $facturacionGrifo
     * @return \Illuminate\Http\Response
     */
    public function show(FacturacionGrifo $facturacionGrifo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\FacturacionGrifo  $facturacionGrifo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $facturacion = FacturacionGrifo::findOrFail($id)->with('grifo')->first();
        return response()->json(['facturacion' => $facturacion ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\FacturacionGrifo  $facturacionGrifo
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFacturacionGrifoRequest $request, $id)
    {  

        $id = $request->id;       
        FacturacionGrifo::findOrFail($id)->update($request->validated());

        return back()->with(['alert-type' => 'success', 'status' => 'Facturacion Grifo Actualizado con exito']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\FacturacionGrifo  $facturacionGrifo
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacturacionGrifo $facturacionGrifo)
    {
        //
    }
}
