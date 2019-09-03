<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

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
}
