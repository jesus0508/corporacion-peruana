<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class FacturaProveedor extends Model
{
    protected $table = 'factura_proveedors';
    protected $primaryKey = 'id';
    protected $fillable= ['id','nro_factura_proveedor','monto_factura' ,'fecha_factura_proveedor'];

    public function pedidos(){
        return $this->belongsTo(Pedido::class);
    }
}
