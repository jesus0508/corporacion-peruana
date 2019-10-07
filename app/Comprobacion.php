<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class Comprobacion extends Model
{
    protected $table = 'comprobacions';
    protected $fillable= ['detalle','fecha','monto','fecha_reporte'];
}
