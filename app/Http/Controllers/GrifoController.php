<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Grifo;
use Illuminate\Http\Request;
use CorporacionPeru\Http\Requests\StoreGrifoRequest;
use CorporacionPeru\IngresoGrifo;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Log;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGrifoRequest $request)
    {
        //
        Grifo::create($request->validated());
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
        //
        return response()->json(['grifo' => $grifo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\Grifo  $grifo
     * @return \Illuminate\Http\Response
     */
    public function edit(Grifo $grifo)
    {
        //
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
        //
        $id = $request->id;
        Grifo::findOrFail($id)->update($request->validated());
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
        //
        $grifo->delete();
        return back()->with(['alert-type' => 'success', 'status' => 'Grifo eliminado con exito']);
    }

    public function getGrifosSinIngreso($fecha = null)
    {
        Log::info('Entro la peticion');
        
        if($fecha){
            $fecha = Carbon::createFromFormat('d-m-Y', $fecha)->format('Y-m-d');
            Log::info('Fecha de '.$fecha);
        }else{
            $fecha = Carbon::today();
        }
        $grifos = Grifo::select('id', 'razon_social as text')->whereHas('latestIngresoGrifos', function (Builder $query)  use ($fecha) {
            $query->whereDate('ingreso_grifos.fecha_ingreso', '<', $fecha);
        })->orWhereDoesntHave('ingresoGrifos')->get();
        return response()->json(['grifos' => $grifos]);
    }
}
