<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Egreso extends Model
{
    protected $table = 'egresos';
    protected $fillable= ['monto_egreso','fecha_egreso','grifo_id','concepto_gasto_id'];

    public function conceptoGasto(){
        return $this->belongsTo(ConceptoGasto::class);
    }
    public function grifo(){
        return $this->belongsTo(Grifo::class);
	}

	public function setFechaEgresoAttribute($value){ 
        $this->attributes['fecha_egreso'] = Carbon::createFromFormat('d/m/Y',$value);
    }
}
