<?php

namespace CorporacionPeru\Http\Controllers;

use Illuminate\Http\Request;
use CorporacionPeru\CategoriaGasto;
use CorporacionPeru\SubCategoriaGasto;
use CorporacionPeru\Grifo;
use CorporacionPeru\Egreso;
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
        $egresos = Egreso::join('concepto_gastos','concepto_gastos.id','=','egresos.concepto_gasto_id')
                    ->join('sub_categoria_gastos','sub_categoria_gastos.id','=','concepto_gastos.sub_categoria_gasto_id')
                    ->join('categoria_gastos','categoria_gastos.id','=','sub_categoria_gastos.categoria_gasto_id')
                    ->join('grifos','grifos.id','=','egresos.grifo_id')
                    ->select('egresos.monto_egreso','egresos.fecha_egreso',
                                'grifos.razon_social as grifo',
                                'categoria_gastos.categoria',
                                'sub_categoria_gastos.subcategoria',
                                'concepto_gastos.concepto'
                            )
                    ->get();






    	return view('gastos.registro.index',compact('categorias','grifos','egresos'));
      //  return view('pedidosP.create', compact('plantas'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //  return $request;
        Egreso::create($request->all());
        return  back()->with('alert-type', 'success')->with('status', 'Egreso registrado con exito');
    }

}
