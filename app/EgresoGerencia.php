<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EgresoGerencia extends Model
{
   	protected $table = 'egreso_gerencias';
    protected $fillable= ['monto','fecha','nombre','concepto','comprobante_pago','estado','asignacion'];


 	public function setFechaAttribute($value)
    {
        $this->attributes['fecha'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getFechaAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }

    public function getTipoComprobante(){
        $result="";
        switch($this->comprobante_pago){

            case 4: 
                $result="Boleta de Venta";
                break; 	
        	case 3: 
                $result="Factura";
                break;
            case 2: 
                $result="Recibo";
                break;
            case 1:
                $result="Sin Comprobante";
                break;
        }
        return $result;
    }

    public function getNombre(){
        $result="";
        switch($this->nombre){
            case 2: 
                $result="Corporacion";
                break;
            case 1:
                $result="Familia";
                break;
        }
        return $result;
    }

    public function getEstado(){
        $result="";
        switch($this->nombre){
            case 3: 
                $result="Pagado";
                break;
            case 2: 
                $result="Amortizado";
                break;                
            case 1:
                $result="Por pagar";
                break;
        }
        return $result;
    }

}
