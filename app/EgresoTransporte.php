<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EgresoTransporte extends Model
{
    protected $table = 'egreso_transportes';
    protected $fillable = [
        'transporte_id', 'fecha_reporte','monto_egreso',
        'fecha_egreso','descripcion','nro_comprobante','tipo_comprobante'
    ];
    protected $dates = ['deleted_at'];

    public function transporte()
    {
        return $this->belongsTo(Transporte::class);
    }

    public function getTipoComprobante(){
        $result="";
        switch($this->tipo_comprobante){
            case 5: 
                $result="Proforma simple";
                break;  
        	case 4: 
                $result="Comprobante interno";
                break;
        	case 3: 
                $result="Comprobante";
                break;
            case 2: 
                $result="Factura";
                break;
            case 1:
                $result="Boleta";
                break;
        }
        return $result;
    }
    public function setFechaEgresoAttribute($value)
    {
        $this->attributes['fecha_egreso'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function setFechaReporteAttribute($value)
    {
        $this->attributes['fecha_reporte'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }
    public function getFechaEgresoAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }

    public function getFechaReporteAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }
}
