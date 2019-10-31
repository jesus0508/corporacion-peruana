<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Serie;
use CorporacionPeru\Grifo;
use Illuminate\Http\Request;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $series = Serie::with('grifo')->get();

        return view('grifos.series.gestion.index',compact('series'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function asignar_series(Request $request)
    {
        $id = $request->id;//id_grifo
        $array_series = $request->series;
        $grifo = Grifo::findOrFail($id)->with('series')->first();
        $series_grifo_old = $grifo->series;
        //TRANSACTION AGREGAR LUEGOP
        foreach ($series_grifo_old as $serie) {
            $serie = Serie::findOrFail($serie->id);
            $serie->grifo_id=null;
            $serie->save();           
        }
        if ($array_series) {
            foreach ($array_series as $id_serie) {
                $serie = Serie::findOrFail($id_serie);
                $serie->grifo_id=$id;
                $serie->save();
            }
        }
       
        //END TRANSACTION

        return back()->with(['alert-type' => 'success', 'status' => 'Series (des)asignadas con exito']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $serie_add = str_pad($request->nro, 3, "0", STR_PAD_LEFT);
        $serie_validada = $request->validate([
            'serie' =>  'unique:series|max:255',
            'nro' =>  'required|unique:series|numeric|gt:0|max:255',
        ]); 
  
        $serie = Serie::create($serie_validada);
        Serie::findOrFail($serie->id)->update([
            'serie' => 'Serie'.$serie_add
        ]);  
        return back()->with(['alert-type' => 'success', 'status' => 'Serie creada con exito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function show(Grifo $grifo)
    {
        $grifo = Grifo::with('series')->first();      
        $series= Serie::all();
        $hasSerie = false;
        $numSeries = count($grifo->series);
        if ($numSeries>0) {
            $hasSerie = true; 
        }

        return view('grifos.series.asignacion.index',compact('grifo','series','hasSerie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function edit(Serie $serie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //falta validacion
        $id = $request->id;
        $serie_add = str_pad($request->nro, 3, "0", STR_PAD_LEFT);
        Serie::findOrFail($id)->update([
            'nro'=> $request->nro,
            'serie'=>'Serie'.$serie_add
        ]);
        //return  Serie::findOrFail($id);
        return  back()->with('alert-type', 'success')->with('status', 'Serie editada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Serie $serie)
    {
       
        if ($serie->grifo_id) {
            return  back()->with('alert-type', 'warning')->with('status', 'Numero de serie asociado a un grifo, desaciar primero');
        }
        $serie->delete();
        return  back()->with('alert-type', 'success')->with('status', 'Serie eliminada con exito');
    }
}
