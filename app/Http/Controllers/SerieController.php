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
        // foreach ($series_grifo_old as $serie) {
        //     $serie = Serie::findOrFail($serie->id);
        //     $serie->grifo_id=null;
        //     $serie->save();           
        // }
        if ($array_series) {
            foreach ($array_series as $id_serie) {
                $serie = Serie::findOrFail($id_serie);
                $serie->grifo_id=$id;
                $serie->save();
            }
        }
       
        //END TRANSACTION

        return back()->with(['alert-type' => 'success', 'status' => 'Series asignadas con exito']);
    }
    /**
     * Elimina gestion_id de series.
     * @param  [type] $grifo_id
     * @return [type]     [description]
     */
    public function eliminar_asignacion($id){
        Serie::findOrFail($id)->update([
            'grifo_id' => null
        ]);

        return back()->with(['alert-type' => 'success', 'status' => 'Series desasignada de grifo']);   

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $serie_add = str_pad($request->nro, 2, "0", STR_PAD_LEFT);

        if ( Serie::where('nro', '=', $request->nro )->exists()) {   // serie found

            return back()->with(['alert-type' => 'error', 'status' => 'La Serie '.$request->nro.' ya existe. Intente con otra serie']);
        }else{
            $serie = Serie::create([
                'nro' => $request->nro ,
                'serie' => 'Serie '.$serie_add
            ]);

            return back()->with(['alert-type' => 'success', 'status' => 'Serie creada con exito']);
        }
    }

    /**
     * Vista asignar series
     *
     * @param  \CorporacionPeru\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {      
        $grifo = Grifo::with('series')->where('id','=',$id)->first(); 

        $series= Serie::where('grifo_id','=',null)->get();
        $hasSerie = false;
        if ($grifo->series) {
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
    public function destroy($id)
    {
       $serie = Serie::findOrFail($id);
        if ($serie->grifo_id) {
            return  back()->with('alert-type', 'warning')->with('status', 'Numero de serie asociado a un grifo, desaciar primero');
        }
        $serie->delete();
        return  back()->with('alert-type', 'success')->with('status', 'Serie eliminada con exito');
    }
}
