<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PagoCliente extends Model
{
    protected $table = 'pago_clientes';
    protected $fillable= ['fecha_operacion','codigo_operacion','monto_operacion','banco','pedido_cliente_id'];
    
    public function pedidoCliente(){
        return $this->belongsTo(PedidoCliente::class);
    }
    
    public function setFechaOperacionAttribute($value){ 
        $this->attributes['fecha_operacion']=Carbon::createFromFormat('d/m/Y',$value)->format('Y-m-d');
    }
    
}
