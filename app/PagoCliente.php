<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PagoCliente extends Model
{
    protected $table = 'pago_clientes';
    protected $fillable= ['fecha_operacion','codigo_operacion','monto_operacion','banco'];
    
    public function pedidoClientes(){
        return $this->belongsToMany(PedidoCliente::class);
    }
    
    public function setFechaOperacionAttribute($value){ 
        $this->attributes['fecha_operacion']=Carbon::createFromFormat('d/m/Y',$value)->format('Y-m-d');
    }
    
}
