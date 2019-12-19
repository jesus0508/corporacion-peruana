<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class IngresoGrifo extends Model
{
    //
    protected $table = 'ingreso_grifos';
    protected $fillable = [
        'lectura_inicial', 'lectura_final', 'calibracion','monto_ingreso',
        'fecha_ingreso', 'fecha_reporte', 'precio_galon', 'grifo_id','categoria_ingreso_id',
        'total_galones_factura','total_galones_boleta','facturacion'
    ];

    public function grifo()
    {
        return $this->belongsTo(Grifo::class);
    }
    
    public function categoriaIngreso(){
        return $this->belongsTo(CategoriaIngreso::class);
    }

    public function cancelaciones(){
        return $this->hasMany(Cancelacion::class);
    }

    public function setFechaIngresoAttribute($value)
    {
        $this->attributes['fecha_ingreso'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    public function setFechaReporteAttribute($value)
    {
        $this->attributes['fecha_reporte'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    public function getFechaIngresoAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }

    // public function getFechaReporteAttribute($value)
    // {
    //     return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    // }
}
