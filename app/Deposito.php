<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Deposito extends Model
{
	protected $table = 'depositos';
    protected $fillable= ['monto','detalle','codigo_operacion',
    'fecha_reporte','banco','cuenta_id'];

    public function cuenta(){
        return $this->belongsTo(Cuenta::class);
    }

    public function setFechaReporteAttribute($value){ 
        $this->attributes['fecha_reporte'] = Carbon::createFromFormat('d/m/Y',$value);
    }

    public function getFechaReporteAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }
}
