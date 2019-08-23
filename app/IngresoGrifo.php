<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class IngresoGrifo extends Model
{
    //
    protected $table = 'ingreso_grifos';
    protected $fillable = [
        'lectura_inicial', 'lectura_final', 'calibracion',
        'fecha_ingreso', 'precio_galon', 'grifo_id'
    ];

    public function grifo()
    {
        return $this->belongsTo(Grifo::class);
    }

    public function setFechaIngresoAttribute($value)
    {
        $this->attributes['fecha_ingreso'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    public function getFechaIngresoAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }
}
