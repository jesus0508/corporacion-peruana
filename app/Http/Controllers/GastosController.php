<?php

namespace CorporacionPeru\Http\Controllers;

use Illuminate\Http\Request;
use CorporacionPeru\CategoriaGasto;
use CorporacionPeru\SubCategoriaGasto;
use CorporacionPeru\Grifo;
use CorporacionPeru\Egreso;
use CorporacionPeru\ConceptoGasto;

class GastosController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $categorias = CategoriaGasto::orderBy('id','desc')->get();
        $categorias_asc = CategoriaGasto::all();
        $last_cat   = $categorias_asc->last();
        if( $last_cat ){
            $last_id = $last_cat->id+1;
            $new_codigo_categoria = str_pad($last_id,3,'0');
        }else{
            $new_codigo_categoria = '100';
        }
        $subcategorias = SubCategoriaGasto::orderBy('id','desc')->get();
        $subcategorias_asc = SubCategoriaGasto::all();
        $last_subcat   = $subcategorias_asc->last();
        if(! $last_subcat ){
            $new_codigo_subcategoria = '100';
        }else{
            $new_codigo_subcategoria = null;
        }    

        return view('gastos.index',compact('categorias','new_codigo_categoria',
                                            'subcategorias','new_codigo_subcategoria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = CategoriaGasto::orderBy('id','desc')->get();
        $grifos = Grifo::all();
        $conceptos = ConceptoGasto::join('sub_categoria_gastos','sub_categoria_gastos.id','=','concepto_gastos.sub_categoria_gasto_id')
                    ->join('categoria_gastos','categoria_gastos.id','=','sub_categoria_gastos.categoria_gasto_id')
                    ->select('categoria_gastos.categoria',
                             'sub_categoria_gastos.subcategoria',
                                'concepto_gastos.*'
                            )
                    ->get();



        return view( 'gastos.registro2.index', compact('grifos','conceptos') );
  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(StoreEgresoRequest $request)
    {
        Egreso::create($request->validated());
        return back()->with('alert-type','success')->with('status','Egreso registrado con exito');
    }

}
