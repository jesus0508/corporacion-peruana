<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Cancelacion extends Model
{
    protected $table = 'cancelacions';
    protected $fillable= ['id','monto','nro_operacion','fecha','facturacion_grifo_id'];
    protected $dates = ['deleted_at'];


    public function facturacionGrifo(){
    	return $this->belongsTo(FacturacionGrifo::class);
    }

    public function setFechaAttribute($value){
		$this->attributes['fecha'] = Carbon::createFromFormat('d/m/Y',$value);
    }    
}
