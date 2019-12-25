<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Movimiento extends Model
{
    //
    protected $table = 'movimientos';
    protected $fillable = ['fecha_operacion', 'fecha_reporte', 'codigo_operacion', 'monto_operacion', 'banco', 'estado'];

    public function setFechaOperacionAttribute($value)
    {
        $this->attributes['fecha_operacion'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function setFechaReporteAttribute($value)
    {
        $this->attributes['fecha_reporte'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getEstado()
    {
        $result = "";
        switch ($this->estado) {
            case 3:
                $result = "Conforme";
                break;
            case 2:
                $result = "Sin Registrar";
                break;
            default:
                $result = "Sin Verificar";
                break;
        }
        return $result;
    }
}
