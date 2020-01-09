<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MovimientoGrifo extends Model
{
    protected $table = 'movimiento_grifos';
    protected $fillable = ['fecha_operacion', 'fecha_reporte', 'grifo_id', 'codigo_operacion', 'monto_operacion', 'banco', 'estado'];

    public function grifo(){
        return $this->belongsTo(Grifo::class);
    }

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
