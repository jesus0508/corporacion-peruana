<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class PagoCliente extends Model
{
    protected $table = 'pago_clientes';
    protected $fillable= ['fecha_operacion','monto_operacion','banco','pedido_cliente_id'];
    
    public function pedidoCliente(){
        $this->belongsTo(PedidoCliente::class);
    }
    
}
