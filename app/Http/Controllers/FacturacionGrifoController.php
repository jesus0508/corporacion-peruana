<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\FacturacionGrifo;
use Illuminate\Http\Request;
use CorporacionPeru\Grifo;
USE CorporacionPeru\Serie;
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
    public function series_grifo($id = null,$fecha = null){

               
        if ( $id!=-1 AND $fecha ) {
            $grifo = Grifo::findOrFail($id);
            $precio_galon = $grifo->precio_galon;
            //series facturadas
            $series = Serie::join('facturacion_grifos','facturacion_grifos.serie_id','=','series.id')
                ->whereDate('facturacion_grifos.fecha_facturacion',$fecha)
                ->select('series.id')
                ->get();

            $series_facturadas_id = [];
            foreach ($series as $serie) {
                $series_facturadas_id[] = $serie->id;
            }

            $series = Serie::join('grifos','grifos.id','=','series.grifo_id')
                ->where('grifos.id',$id)
                ->whereNotIn('series.id',$series_facturadas_id) 
                ->select('series.id', 'series.serie as text')
                ->get();

            return response()->json(['series' => $series,'precio_galon'=> $precio_galon]);
        }else{
            $precio_galon = '';
            $series =[];
            return response()->json(['series' => $series,'precio_galon'=> $precio_galon]);
        }
            
    }


    /**
     * Obtener los grifos que no tienen series facturadas, en la fecha $fecha
     * @param  [type] $fecha [fecha ingresada]
     * @return [type]        [description]
     */
    public function getGrifosSinFacturacion( $fecha  = null){
               
        if ($fecha) {
            //series facturadas
            $series = Serie::join('facturacion_grifos','facturacion_grifos.serie_id','=','series.id')
                ->whereDate('facturacion_grifos.fecha_facturacion',$fecha)
                ->select('series.id')
                ->get();
            $series_facturadas_id = [];
            foreach ($series as $serie) {
                $series_facturadas_id[] = $serie->id;
            }
            $grifos = Grifo::join('series','series.grifo_id','=','grifos.id')
                ->whereNotIn('series.id',$series_facturadas_id)
                ->groupBy('grifos.id')
                ->select('grifos.id', 'grifos.razon_social as text')                   
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

        FacturacionGrifo::create($request->validated());

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
        $facturacion = FacturacionGrifo::findOrFail($id)->with('serie')->with('grifo')->first();
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
