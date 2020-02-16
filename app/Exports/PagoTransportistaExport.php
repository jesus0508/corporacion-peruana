<?php

namespace CorporacionPeru\Exports;

use CorporacionPeru\Pedido;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use CorporacionPeru\Transportista;
use CorporacionPeru\PagoTransportista;

class PagoTransportistaExport implements FromView, ShouldAutoSize
{
  
    public $idPagoTransportista;

    function __construct($idPagoTransportista) {
        $this->idPagoTransportista = $idPagoTransportista;
    }


 /**
    * @return \Illuminate\Support\View
    */
    public function view(): View
    {

        $id=$this->idPagoTransportista;

        $pedidos_cliente
            = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
                ->join('pedido_proveedor_clientes','pedido_proveedor_clientes.pedido_id','=','pedidos.id')
                ->where('pedido_proveedor_clientes.pago_transportista_id','=',$id)
                ->select('pedidos.id','vehiculos.transportista_id')                
                ->get();

        $pedidos_grifo = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                    ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
                    ->join('plantas','plantas.id','=','pedidos.planta_id')
                    ->join('pedido_grifos','pedido_grifos.pedido_id','=','pedidos.id')
                    ->join('grifos','pedido_grifos.grifo_id','=','grifos.id')
                    ->where('pedido_grifos.pago_transportista_id','=',$id) 
                    ->select('pedidos.id','vehiculos.transportista_id')                     
                    ->get();
  
        $collection = collect([$pedidos_grifo, $pedidos_cliente]);
        $collapsed = $collection->collapse();
        $pedidos2 =$collapsed->all();
        $transportista = Transportista::findOrFail( $pedidos2[0]->transportista_id );
        $array_selected = [];
        foreach ($pedidos2 as $pedido) {
            if (!in_array($pedido->id, $array_selected)) {
                $array_selected[] = $pedido->id;
            }            
        }
        $pedidos = Pedido::with('pedidoProveedorClientes')
                ->with('pedidoProveedorGrifos')
                ->whereIn('id',$array_selected)
                ->get(); 

        $subtotal = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                ->join('transportistas','transportistas.id','vehiculos.transportista_id')
                ->whereNotNull('pedidos.vehiculo_id')
                ->where('transportistas.id',$transportista->id)
                ->where('pedidos.estado_flete',2)//pagado
                ->whereIn('pedidos.id',$array_selected)  
                ->sum('pedidos.costo_flete');

        $pago_transportista = PagoTransportista::findOrFail($id); 
       

        $lista_descuento1

                     = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                    ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
                    ->join('pedido_proveedor_clientes','pedido_proveedor_clientes.pedido_id','=','pedidos.id')
                    ->join('pedido_clientes','pedido_clientes.id','=','pedido_proveedor_clientes.pedido_cliente_id')
                    ->join('clientes','clientes.id','=','pedido_clientes.cliente_id')
                    ->join('plantas','plantas.id','=','pedidos.planta_id')
                    ->where('pedido_proveedor_clientes.pago_transportista_id','=',$id)
                    ->whereNotNull('pedido_proveedor_clientes.faltante')                 
                    ->select('pedido_clientes.fecha_descarga', 'clientes.razon_social',
                            'pedido_clientes.galones','pedido_clientes.horario_descarga',
                            'pedidos.scop','pedidos.nro_pedido','pedidos.id',
                            'plantas.planta', 'pedidos.estado_flete',
                            'transportistas.nombre_transportista','pedido_clientes.observacion','pedidos.costo_galon',
                            'pedido_proveedor_clientes.faltante',
                            'pedido_proveedor_clientes.precio_galon_faltante as costo_galon',
                            'pedido_proveedor_clientes.grifero',
                            'pedido_proveedor_clientes.descripcion')
                    ->get();

        $lista_descuento2 = Pedido::join('vehiculos','pedidos.vehiculo_id','=','vehiculos.id')
                    ->join('transportistas','transportistas.id','=','vehiculos.transportista_id')
                    ->join('plantas','plantas.id','=','pedidos.planta_id')
                    ->join('pedido_grifos','pedido_grifos.pedido_id','=','pedidos.id')
                    ->join('grifos','pedido_grifos.grifo_id','=','grifos.id')                    
                    ->where('pedido_grifos.pago_transportista_id','=',$id)
                    ->whereNotNull('pedido_grifos.faltante')
                    ->select('grifos.razon_social',
                            'pedido_grifos.asignacion as galones',                            
                            'pedidos.scop','pedidos.nro_pedido','pedidos.id',
                            'plantas.planta', 'pedidos.estado_flete',
                            'transportistas.nombre_transportista',
                            'pedido_grifos.faltante',
                            'pedido_grifos.precio_galon_faltante as costo_galon',
                            'pedido_grifos.grifero',
                            'pedido_grifos.descripcion')
                    ->get();

            $collection = collect([$lista_descuento1, $lista_descuento2]);
            $collapsed = $collection->collapse();
            $lista_descuento =$collapsed->all();

        //descuento
        $desc = 0;
        foreach ($lista_descuento as $faltante){              
        $desc += number_format((float)
                                    $faltante->faltante * $faltante->costo_galon, 2, '.', '');
         }		

		return view('pago_transportistas.resumen.table_resumen',
            ['pedidos' => $pedidos , 'subtotal'=> $subtotal, 
            'lista_descuento'=> $lista_descuento,
            'transportista'=> $transportista, 'desc'=> $desc ,
             'pago_transportista'=> $pago_transportista]);
    }
}
