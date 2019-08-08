<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class PagoProveedor extends Model
{
    protected $table = 'pago_proveedors';
    protected $fillable= ['fecha_operacion','codigo_operacion','monto_operacion','banco'];
    

    public function pedidos(){
        return $this->belongsToMany(Pedido::class,'pago_pedido_proveedors');        
    }
    
   }
