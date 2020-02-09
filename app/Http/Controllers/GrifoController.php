<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Grifo;
use Illuminate\Http\Request;
use CorporacionPeru\Http\Requests\StoreGrifoRequest;
use CorporacionPeru\Http\Requests\StoreBalanceoRequest;
use CorporacionPeru\IngresoGrifo;
use CorporacionPeru\Egreso;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Log;
use CorporacionPeru\Stock;
use CorporacionPeru\Balanceo;
use CorporacionPeru\MovimientoGrifo;

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
     * Comparación entre movimientos grifo y movimientos
     *
     * @return \Illuminate\Http\Response
     */
    public function reporteComparacion()
    {
        $today = strftime( '%d/%m/%Y',strtotime('now') );
        return view('grifos.reporte_comparacion.index',compact('today'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reporteComparacionData($date = null)
    {
        if ( $date == null ) {
            $date = Carbon::now()->format('Y-m-d');
        }

        $ingreso = IngresoGrifo::rightJoin('grifos','grifos.id','=','ingreso_grifos.grifo_id')
                    ->select('ingreso_grifos.fecha_ingreso as fecha',
                                'grifos.razon_social as grifo',
                     DB::raw('(sum(monto_ingreso)) as monto') ,'grifo_id')
                    ->where('fecha_ingreso',$date)
                    ->groupBy('fecha')->first();

        $egreso = Egreso::rightJoin('grifos','grifos.id','=','egresos.grifo_id')
                ->select('egresos.fecha_egreso as fecha','fecha_reporte', 'grifo_id',
                    'grifos.razon_social as grifo', DB::raw('(sum(monto_egreso)) as monto'))
                ->where('fecha_egreso',$date)
                ->groupBy('fecha')->first();

        $ingreso_monto = ($ingreso) ? $ingreso->monto : 0.00;
        $egreso_monto  = ($egreso) ? $egreso->monto : 0.00;
        $neto          = $ingreso_monto  - $egreso_monto;

        $movimiento = MovimientoGrifo::select('movimiento_grifos.fecha_reporte as fecha', DB::raw('(sum(monto_operacion)) as monto'))
                ->where('fecha_reporte',$date)
                ->groupBy('fecha')->first();
        $movimiento_monto = ($movimiento) ? $movimiento->monto : 0.00;
        //Creamos array de Comparaciones
        $comparaciones = collect([]);
        $date = Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
        $comparacion =[    
            'fecha_ingreso'            => $date,
            'ingreso_neto'             => $neto,
            'ingreso_movimiento_total' => $movimiento_monto,
            'diferencia'               => $neto - $movimiento_monto
        ];  
        $comparacion = (object)$comparacion;                  
        $comparaciones->push($comparacion); 
    

        return response()->json(['data' => $comparaciones]);
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
