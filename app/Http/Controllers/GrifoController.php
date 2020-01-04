<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Grifo;
use Illuminate\Http\Request;
use CorporacionPeru\Http\Requests\StoreGrifoRequest;
use CorporacionPeru\Http\Requests\StoreBalanceoRequest;
use CorporacionPeru\IngresoGrifo;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Log;
use CorporacionPeru\Stock;
use CorporacionPeru\Balanceo;

class GrifoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $grifos = Grifo::all();
        return view('grifos.index', compact('grifos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

        /**
     * Show all clientes.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllGrifos()
    {
        $grifos = Grifo::select('id', 'razon_social as text','stock')->get();
        return response()->json(['grifos' => $grifos]);
    }


    /**
     * Balancear galonaje grifos
     *
     * @return \Illuminate\Http\Response
     */
    public function balancear(StoreBalanceoRequest $request)
    {
        //return $request;
        $grifo1_id = $request->grifo_id_sender;
        $grifo2_id = $request->grifo_id_receiver;
        if ($grifo1_id==$grifo2_id) {      
            return back()->with(['alert-type' => 'warning', 'status' => 'Escoja grifos diferentes']);
        }else{
            //START TRANSACTION
            $grifo1 = Grifo::findOrFail($grifo1_id);
            $grifo2 = Grifo::findOrFail($grifo2_id);
            $grifo1->stock -= $request->cantidad;
            $grifo2->stock += $request->cantidad;
            $grifo1->save();
            $grifo2->save();
            //REGISTRAR BALANCEO
            Balanceo::create( $request->validated() );
            
            return back()->with(['alert-type' => 'success', 'status' => 'Balanceo realizado con exito']);
        }
        $grifos = Grifo::all();
        $balanceos = Balanceo::orderBy('id','desc')->get();
        return view('grifos.balanceo.index',compact('balanceos','grifos'));
    }

    /**
     * Lleva a la vista balanceo galonaje grifos
     *
     * @return \Illuminate\Http\Response
     */
    public function balanceo()
    {
        $grifos = Grifo::all();
        $balanceos = Balanceo::join('grifos',
                'balanceos.grifo_id_sender','=','grifos.id')
            ->join('grifos as g','balanceos.grifo_id_receiver','g.id')
            ->select('grifos.razon_social as grifo_sender','balanceos.*','g.razon_social as grifo_receiver')
            ->orderBy('balanceos.fecha','desc')
            ->get();
        return view('grifos.balanceo.index',compact('balanceos','grifos'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGrifoRequest $request)
    {
        //
        $grifo = Grifo::create($request->validated());
        $stock = Stock::first();
        $stock->stock_general += $grifo->stock;
        $stock->save();
        return back()->with(['alert-type' => 'success', 'status' => 'Grifo registrado con exito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Grifo  $grifo
     * @return \Illuminate\Http\Response
     */
    public function show(Grifo $grifo)
    {
       $zonas = config('constants.zonas');
        return response()->json(['grifo' => $grifo, 'zonas' => $zonas]);       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\Grifo  $grifo
     * @return \Illuminate\Http\Response
     */
    public function edit(Grifo $grifo)
    {
        return response()->json(['grifo' => $grifo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGrifoRequest $request, $id)
    {
       // return $request;
        $id = $request->id;
        $grifo_anterior = Grifo::findOrFail($id);                
        $gls_anterior = $grifo_anterior->stock;
        $grifo = Grifo::findOrFail($id);
        Grifo::findOrFail($id)->update($request->validated());
        $gls_nuevo = $grifo->stock; 

        $stock = Stock::first();       
        $stock->stock_general -= $gls_anterior;
        $stock->stock_general += $gls_nuevo;
        $stock->save();   


        return back()->with(['alert-type' => 'success', 'status' => 'Grifo editado con exito']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\Grifo  $grifo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grifo $grifo)
    {
       
        try {
            $grifo->delete();
            $stock = Stock::first();
            $stock->stock_general -= $grifo->stock;
            $stock->save(); 

            return back()->with(['alert-type' => 'success', 'status' => 'Grifo eliminado con exito']);
        } catch (\Illuminate\Database\QueryException $e) {
                
                return back()->with(['alert-type' => 'error', 'status' => $grifo->razon_social.' no puede ser eliminado!']);
            }

    }
    /**
     * [getGrifosSinIngreso description]
     * @param  [type] $fecha [Fecha de reporte]
     * @return [type]        [description]
     */
    public function getGrifosSinIngreso($fecha = null)//by Fecha reporte
    {
        if ($fecha) {
            $grifos = Grifo::join('ingreso_grifos','ingreso_grifos.grifo_id','=','grifos.id')
                        ->whereDate('ingreso_grifos.fecha_reporte',$fecha)
                        ->select('grifos.id')
                        ->get();
            $grifos_con_ingresos_id = [];
            foreach ($grifos as $grifo) {
                $grifos_con_ingresos_id[] = $grifo->id;
            }
            //return $grifos_con_ingresos_id;
            $grifos = Grifo::select('id', 'razon_social as text')->whereNotIn('id',$grifos_con_ingresos_id)                   
            ->get();
            return response()->json(['grifos' => $grifos]);
        }else{

            $grifos =[];
            return response()->json(['grifos' => $grifos]);
        }
    }
}
