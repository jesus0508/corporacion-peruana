<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\StockGrifo;
use Illuminate\Http\Request;
use CorporacionPeru\Grifo;
use CorporacionPeru\Http\Requests\StoreStockGrifoRequest;

class StockGrifoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()    
    {   
        $grifos = Grifo::all();

        $stock_grifos = StockGrifo::orderBy('id', 'DESC')->get();
        $stock_grifos = StockGrifo::join('grifos','grifos.id','=','stock_grifos.grifo_id')->select('stock_grifos.*','grifos.razon_social','grifos.stock')->get();

//return $stock_grifos;
        return view('stock_grifos.gestion.index',compact('stock_grifos','grifos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stock_grifos.index');
    }
    /**
     * Obtener grifos q no se ahn registrado su stock
     */

    public function getGrifosSinStockRegistrado($fecha = null){
        if ($fecha) {
            $grifos = Grifo::join('stock_grifos','stock_grifos.grifo_id','=','grifos.id')
                        ->whereDate('stock_grifos.fecha_stock',$fecha)
                        ->select('grifos.id')
                        ->get();
            $grifos_with_stock = [];
            foreach ($grifos as $grifo) {
                $grifos_with_stock[] = $grifo->id;
            }
            //return $grifos_with_stock;
            $grifos = Grifo::select('id', 'razon_social as text')->whereNotIn('id',$grifos_with_stock)                   
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
    public function store(StoreStockGrifoRequest $request)
    {
        //return $request->validated();
        $nuevo_stock = $request->new_stock;
        StockGrifo::create($request->validated());
        //actualizar stock grifos
    

        return back()->with('alert-type', 'success')->with('status', 'Stock Registrado con exito');


    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\StockGrifo  $stockGrifo
     * @return \Illuminate\Http\Response
     */
    public function show(StockGrifo $stockGrifo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\StockGrifo  $stockGrifo
     * @return \Illuminate\Http\Response
     */
    public function edit(StockGrifo $stockGrifo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\StockGrifo  $stockGrifo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockGrifo $stockGrifo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\StockGrifo  $stockGrifo
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockGrifo $stockGrifo)
    {
        //
    }
}
