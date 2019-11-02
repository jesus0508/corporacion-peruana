<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class FacturaCliente extends Model
{
    //
    protected $table = 'factura_clientes';
    protected $fillable= ['nro_factura', 'monto_factura', 'fecha_factura'];

    public function pedido(){
        return $this->hasOne(PedidoCliente::class);
    }

    public function setFechaFacturaAttribute($value){ 
        $this->attributes['fecha_factura'] = Carbon::createFromFormat('d/m/Y',$value);
    }

}
