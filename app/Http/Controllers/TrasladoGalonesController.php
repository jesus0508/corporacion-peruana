<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\TrasladoGalones;
use Illuminate\Http\Request;
use CorporacionPeru\Proveedor;
use CorporacionPeru\Stock;
use CorporacionPeru\Http\Requests\StoreTrasladoGalonesRequest;
use DB;
use Carbon\Carbon;

class TrasladoGalonesController extends Controller
{

    /**
     * Muestra tabla reporte stock_Grifos TOTALES
     */

    public function reporteGrifosClientesDiario(){
            $today = Carbon::now()->format('d/m/Y');
        return view('traslado_galones.reportes.diario.index',compact('today'));
    }

    /**
     * Datos para datatable, pedido ajax
     * @param  [date] $date ['Y-m-d']
     * @return [type]       [description]
     */
    public function reporteGrifosClientesDiarioData($date = null){
        if ( $date == null ) {
            $date = Carbon::now()->format('Y-m-d');
        }
       $traslados_grifos = DB::select('select p.razon_social , ifnull(tg.fecha,?) as fecha, ifnull(sum(tg.cantidad),0) as total_grifos  FROM (SELECT proveedores.id, proveedores.razon_social  FROM proveedores) as p LEFT JOIN (select proveedor_id,cantidad,fecha FROM traslado_galones WHERE tipo=? AND fecha =?) 
        as tg ON  p.id =tg.proveedor_id group by p.id , tg.fecha', [$date,1,$date]);

       $traslados_clientes = DB::select('select p.razon_social , ifnull(tg.fecha,?) as fecha, ifnull(sum(tg.cantidad),0) as total_clientes  FROM (SELECT proveedores.id, proveedores.razon_social  FROM proveedores) as p LEFT JOIN (select proveedor_id,cantidad,fecha FROM traslado_galones WHERE tipo=? AND fecha =?) 
        as tg ON  p.id =tg.proveedor_id group by p.id , tg.fecha', [$date,2,$date]);
        $traslados = collect([]); 
        foreach ($traslados_grifos as $traslado1) {
            foreach ($traslados_clientes as $traslado2) {
                if ($traslado1->razon_social == $traslado2->razon_social ) {
                    
                    $consolidado = $traslado1->total_grifos + $traslado2->total_clientes;
                    $consolidado = round( $consolidado, 2 );
                    $neto =[    
                            'fecha'        => $traslado1->fecha, 
                            'razon_social' => $traslado1->razon_social,
                            'grifos'       => $traslado1->total_grifos,
                            'clientes'     => $traslado2->total_clientes,
                            'total'        => $consolidado 
                        ];    
                    $neto = (object)$neto;                  
                    $traslados->push($neto);
                }
            
            }  
        }
        return response()->json(['data' => $traslados]);
    }

    /**
     * Muestra tabla reporte stock_Grifos TOTALES
     */

    public function reporteGrifosClientesMensual(){
           // $today = Carbon::now()->format('d/m/Y');
        return view('traslado_galones.reportes.mensual.index');
    }

    /**
     * Datos para datatable, pedido ajax
     * @param  [date] $date ['Y-m-d']
     * @return [type]       [description]
     */
    public function reporteGrifosClientesMensualData($date = null){

       if ( $date == null ) {
            $date = Carbon::now()->format('m-Y');
            }    
        list($numero_mes, $year) = explode("-", $date);
        
        $traslados_clientes = DB::select('select  p.razon_social, ifnull(concat(tg.mes,"-",tg.anio),?) as fecha 
        ,ifnull(sum(tg.cantidad),0) as total_clientes from 
        (select proveedores.id, proveedores.razon_social  from proveedores) as p 
        left join 
        (select proveedor_id, cantidad  , YEAR(fecha) as anio , MONTH(fecha) as mes , fecha
        from traslado_galones where tipo=? and month(fecha)= ?
            and year(fecha)=?) 
        as tg ON  p.id =tg.proveedor_id group by p.id , tg.mes , tg.anio;', [$date,2,$numero_mes,$year]);

        $traslados_grifos = DB::select('select  p.razon_social, ifnull(concat(tg.mes,"-",tg.anio),?) as fecha 
        ,ifnull(sum(tg.cantidad),0) as total_grifos from 
        (select proveedores.id, proveedores.razon_social  from proveedores) as p 
        left join 
        (select proveedor_id, cantidad  , YEAR(fecha) as anio , MONTH(fecha) as mes , fecha
        from traslado_galones where tipo=? and month(fecha)= ?
            and year(fecha)=?) 
        as tg ON  p.id =tg.proveedor_id group by p.id , tg.mes , tg.anio;', 
                [$date,1,$numero_mes,$year]);
        
        $traslados = collect([]); 
        foreach ($traslados_grifos as $traslado1) {
            foreach ($traslados_clientes as $traslado2) {
                if ($traslado1->razon_social == $traslado2->razon_social ) {
                    
                    $consolidado = $traslado1->total_grifos + $traslado2->total_clientes;
                    $consolidado = round( $consolidado, 2 );
                    $neto =[    
                            'fecha'        => $traslado1->fecha, 
                            'razon_social' => $traslado1->razon_social,
                            'grifos'       => $traslado1->total_grifos,
                            'clientes'     => $traslado2->total_clientes,
                            'total'        => $consolidado 
                        ];    
                    $neto = (object)$neto;                  
                    $traslados->push($neto);
                }
            
            }  
        }
        return response()->json(['data' => $traslados]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedores = Proveedor::orderBy('id', 'DESC')->get();
        $traslados=TrasladoGalones::with('proveedor')->orderBy('id', 'DESC')->get();
        return view('traslado_galones.index',
            compact('proveedores','traslados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrasladoGalonesRequest $request)
    {
        //return $request;
        TrasladoGalones::create($request->validated());
        return back()->with('alert-type', 'success')->with('status', 'Registrado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\TrasladoGalones  $trasladoGalones
     * @return \Illuminate\Http\Response
     */
    public function show(TrasladoGalones $trasladoGalones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\TrasladoGalones  $trasladoGalones
     * @return \Illuminate\Http\Response
     */
    public function edit(TrasladoGalones $trasladoGalones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\TrasladoGalones  $trasladoGalones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TrasladoGalones $trasladoGalones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\TrasladoGalones  $trasladoGalones
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrasladoGalones $trasladoGalones)
    {
        //
    }
}
