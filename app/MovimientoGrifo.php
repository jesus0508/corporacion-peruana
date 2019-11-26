<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MovimientoGrifo extends Model
{
    protected $table = 'movimiento_grifos';
    protected $fillable = ['fecha_operacion', 'codigo_operacion', 'monto_operacion', 'estado'];

    public function setFechaOperacionAttribute($value)
    {
        $this->attributes['fecha_operacion'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
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
