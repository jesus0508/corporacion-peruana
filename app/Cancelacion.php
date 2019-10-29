<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class Cancelacion extends Model
{
    protected $table = 'cancelacions';
    protected $fillable= ['id','monto','nro_operacion','fecha','ingreso_grifo_id'];

    public function ingresoGrifo(){
    	return $this->belongsTo(IngresoGrifo::class);
    }
}
