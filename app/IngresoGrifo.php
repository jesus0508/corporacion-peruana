<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

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
}
