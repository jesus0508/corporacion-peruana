<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Banco;
use Illuminate\Http\Request;
use CorporacionPeru\Http\Requests\StoreBancoRequest;
use CorporacionPeru\Cuenta;

class BancoController extends Controller
{
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
    public function store(StoreBancoRequest $request)
    {
       //return $request->validated();
        Banco::create($request->validated());

        return back()->with('alert-type', 'success')->with('status', 'Banco Registrado con exito');
    }

    /**
     * Mostrar banco detalles, y cuentas de cada banco
     *
     * @param  \CorporacionPeru\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function show(Banco $banco)
    {
        $id = $banco->id;
        $banco = Banco::with('cuentas')->where('id',$id)->first();
        return view('empresa.bancos.index',compact('banco'));
       

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CorporacionPeru\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function edit(Banco $banco)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CorporacionPeru\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banco $banco)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CorporacionPeru\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banco $banco){        
        $exists = Cuenta::where('banco_id',$banco->id)->exists();       
        if ($exists) {
            return  back()->with('alert-type', 'warning')->with('status', 'Banco tiene cuentas existentes ');
        }
        else{
            $banco->delete();
            return  back()->with('alert-type', 'success')->with('status', 'Banco eliminado con exito');
        }
    }
}
