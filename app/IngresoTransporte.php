<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class IngresoTransporte extends Model
{
    protected $table = 'ingreso_transportes';
    protected $fillable = [
        'transporte_id', 'fecha_reporte','monto_ingreso',
        'fecha_ingreso','categoria_ingreso_id'
    ];
    protected $dates = ['deleted_at'];


    public function transporte()
    {
        return $this->belongsTo(Transporte::class);
    }

    public function setFechaIngresoAttribute($value)
    {
        $this->attributes['fecha_ingreso'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function setFechaReporteAttribute($value)
    {
        $this->attributes['fecha_reporte'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }
    public function getFechaIngresoAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }

    public function getFechaReporteAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }
}
