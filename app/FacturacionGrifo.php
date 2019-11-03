<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class FacturacionGrifo extends Model
{
    protected $table = 'facturacion_grifos';
    protected $fillable = ['venta_factura','fecha_facturacion','venta_boleta','precio_venta','numero_factura','grifo_id','series'];
    protected $dates = ['deleted_at'];

    public function cancelaciones(){
        return $this->hasMany(Cancelacion::class);
    }
    public function getGalones(){
        return $this->venta_boleta+ $this->venta_factura;
    }

    public function getMontoTotal(){       
        return $this->getGalones()*$this->precio_venta;
    }

    public function grifo(){
    	return $this->belongsTo(Grifo::class);
    }
    public function setFechaFacturaAttribute($value){ 
        $this->attributes['fecha_facturacion'] = Carbon::createFromFormat('d/m/Y',$value);
    }
}
