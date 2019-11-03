<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class Cancelacion extends Model
{
    protected $table = 'cancelacions';
    protected $fillable= ['id','monto','nro_operacion','fecha','ingreso_grifo_id'];
    protected $dates = ['deleted_at'];


    public function facturaGrifo(){
    	return $this->belongsTo(FacturaGrifo::class);
    }
}
