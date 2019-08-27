<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class FacturaProveedor extends Model
{
    protected $table = 'factura_proveedors';
    protected $primaryKey = 'id';
    protected $fillable= ['id','nro_factura_proveedor','monto_factura' ,'fecha_factura_proveedor'];

    public function pedidos(){
        return $this->belongsTo(Pedido::class);
    }

    public function setFechaFacturaAttribute($value){ 
        $this->attributes['fecha_factura_proveedor']=Carbon::createFromFormat('d/m/Y',$value);
    }

    public function getFechaFacturaAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }
}
