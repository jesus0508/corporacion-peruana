<?php

namespace CorporacionPeru\Exports;

use CorporacionPeru\Pedido;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DistribucionExportView implements FromView, ShouldAutoSize
{
    public $idPedido;
    public $fecha;

    function __construct($fecha, $idPedido) {
        $this->idPedido = $idPedido;
        $this->fecha = $fecha;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $date = $this->fecha;
        $idPedido=$this->idPedido;

        $pedidos = [];
        if ( $idPedido == 0 ) {
            $pedidosDistribuidos = Pedido::where('galones_distribuidos','>',0)
                ->get();
            $pedidos = $pedidosDistribuidos->pluck('id'); 
        }else{
            $pedidos[] = $idPedido;
        }
        if ($date == -1) {//get sin fecha
            $pedidos = Pedido::with('pedidoProveedorClientes')
                ->with('pedidoProveedorGrifos')
                ->whereIn('id',$pedidos)
                ->get(); 
        }else{
            $pedidos = Pedido::with('pedidoProveedorClientes')
                ->with('pedidoProveedorGrifos')
                ->where('fecha_pedido',$date)
                ->whereIn('id',$pedidos)
                ->get();
        }

        return view( 'pedidosP.reporte_combustible.table',['pedidos' => $pedidos]);
    }
}
