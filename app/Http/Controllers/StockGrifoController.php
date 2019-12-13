<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\StockGrifo;
use Illuminate\Http\Request;

class StockGrifoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stock_grifos.index');
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
