<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\ConceptoGasto;
use Illuminate\Http\Request;

class ConceptoGastoController extends Controller
{

     public function getConceptos(Request $request){
        if( $request->ajax() ){
            $gastos = ConceptoGasto::where('sub_categoria_gasto_id',$request->subcategoria_gasto_id)->get();
            foreach ($gastos as $gasto) {
                $gastosArray[ $gasto->id ] = $gasto->concepto;
            }
            return response()->json($gastosArray);
        }
    }

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( $request->ajax() ){

            ConceptoGasto::create($request->all());
                return response()->json([
                'mensaje' => $request->all()
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\ConceptoGasto  $conceptoGasto
     * @return \Illuminate\Http\Response
     */
    public function show( $cod )
    {
       $concepto = ConceptoGasto::where('id',$cod)
        ->with('subCategoriaGasto.categoriaGasto')
        ->first();

        return response()->json(['concepto' => $concepto ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\ConceptoGasto  $conceptoGasto
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        $concepto = ConceptoGasto::join('sub_categoria_gastos','sub_categoria_gastos.id','=','concepto_gastos.sub_categoria_gasto_id')
            ->join('categoria_gastos','categoria_gastos.id','=','sub_categoria_gastos.categoria_gasto_id')
            ->where('concepto_gastos.id',$id)
            ->select('categoria_gastos.categoria',
                'sub_categoria_gastos.subcategoria')
            ->first();
        return $concepto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\ConceptoGasto  $conceptoGasto
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request )
    {
            $id = $request->id;
        ConceptoGasto::findOrFail( $id )->update( $request->all() );
        return  back()->with('alert-type', 'success')->with('status', 'Gasto editado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\ConceptoGasto  $conceptoGasto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        if ($id==0) {
            $id = $request->id;
        }
        $conceptoGasto = ConceptoGasto::findOrFail($id);
        if ( count($conceptoGasto->egresos)==0 ){
           $conceptoGasto->delete();
            return  back()->with('alert-type','success')->with('status','Gasto eliminado con exito');
        }
        return  back()->with('alert-type','error')->with('status','No se puede eliminar, existen gastos registrados.');
    }
}
