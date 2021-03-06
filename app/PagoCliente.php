<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PagoCliente extends Model
{
    protected $table = 'pago_clientes';
    protected $fillable= ['fecha_operacion','fecha_reporte','codigo_operacion','monto_asignado','monto_operacion','banco','categoria_ingreso_id'];
    
    public function pedidoClientes(){
        return $this->belongsToMany(PedidoCliente::class);
    }

    public function pivote()
    {
        return $this->hasMany(PagoPedidoCliente::class);
    }

    public function setFechaOperacionAttribute($value){ 
        $this->attributes['fecha_operacion']=Carbon::createFromFormat('d/m/Y',$value)->format('Y-m-d');
    }

     public function setFechaReporteAttribute($value){ 
        $this->attributes['fecha_reporte']=Carbon::createFromFormat('d/m/Y',$value)->format('Y-m-d');
    }  
}
