<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Empresa;
use CorporacionPeru\Banco;
use CorporacionPeru\Cuenta;
use Illuminate\Http\Request;
use CorporacionPeru\Http\Requests\UpdateEmpresaRequest;
use DB;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa = Empresa::first();

        $bancos = Cuenta::rightJoin('bancos','bancos.id','=','cuentas.banco_id')
                
                ->select('bancos.abreviacion','bancos.id', 'bancos.banco',
                    DB::raw('count(cuentas.id) as total_cuentas') )
                ->groupBy('bancos.abreviacion')
                ->get();
        //$bancos = Banco::with('cuentas')->get();
        //$bancos = $bancos->cuentas->length()
        //return $bancos;
     
        return view( 'empresa.index',compact(  'empresa' ,'bancos' ) );
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \CorporacionPeru\empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(empresa $empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmpresaRequest $request, Empresa $empresa)
    {

        $empresa->update($request->validated());

        return  back()->with('alert-type', 'success')->with('status', 'Empresa editada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        
    }
}
