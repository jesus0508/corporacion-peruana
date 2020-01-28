<?php

namespace CorporacionPeru\Http\Controllers;

use CorporacionPeru\Deposito;
use Illuminate\Http\Request;
use CorporacionPeru\Cuenta;
use CorporacionPeru\PagoCliente;
use Carbon\Carbon;

class ReporteGeneralDepositosController extends Controller
{
	/**
	 *  Muestra reporte general diario de Depositos
	 * @return [view] 
	 */
    public function reporteDepositosDiario()    
    {             
        $today = strftime( '%d/%m/%Y',strtotime('now') );
        return view('reporte_general.depositos.diario.index',compact('today'));
    }

    /**
     * Datos de Reporte general diario de Depositos consultados.
     * @param  [date] $date [fecha de reporte]
     * @return [json]       [formato para datatables]
     */
    public function reporteDepositosDiarioData($date = null){

    	if ( $date == null ) {
	        $date = Carbon::now()->format('Y-m-d');
	    }
	    //Depositos registrados manualmente
        $depositos1 = Deposito::join('cuentas','cuentas.id','=','depositos.cuenta_id')
            ->join('bancos','bancos.id','=','cuentas.banco_id')
            ->where('depositos.fecha_reporte',$date)
            ->select('depositos.*','cuentas.nro_cuenta')
            ->get();  
        //Depositos de clientes venta directa       
        $depositos2 = PagoCliente::join('pago_cliente_pedido_cliente','pago_cliente_pedido_cliente.pago_cliente_id','=','pago_clientes.id')
            ->join('pedido_clientes','pedido_clientes.id','=','pago_cliente_pedido_cliente.pedido_cliente_id')
            ->join('clientes','clientes.id','=','pedido_clientes.cliente_id')
            ->where('pago_clientes.fecha_reporte',$date)
            ->select('pago_clientes.codigo_operacion','pago_clientes.monto_operacion as monto','pago_clientes.banco as nro_cuenta','pago_clientes.fecha_reporte',
                'clientes.razon_social as detalle')
            ->get();
        $collection = collect([$depositos1, $depositos2]);
        $collapsed = $collection->collapse();
        $depositos =$collapsed->all(); 
        return datatables()->of($depositos)->make(true);
        return response()->json(['data' => $depositos]);
    }

}
