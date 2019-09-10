<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PagoProveedor extends Model
{
    protected $table = 'pago_proveedors';
    protected $fillable= ['fecha_operacion','codigo_operacion','monto_operacion','banco'];
    

    public function pedidos(){
        return $this->belongsToMany(Pedido::class,'pago_pedido_proveedors');        
    }

    public function setFechaFacturaAttribute($value){ 
        $this->attributes['fecha_operacion']=Carbon::createFromFormat('d/m/Y',$value);
    }

   }
