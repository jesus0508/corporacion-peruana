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

    public function pagoGastos(){
        return $this->belongsToMany(Salida::class,'pago_gastos_gerencia');        
    }

    public function getFechaAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }

    public function fechaY($value){
        return Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
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
        switch($this->estado){
            case 3: 
                $result="PAGADO";
                break;
            case 2: 
                $result="AMORTIZADO";
                break;                
            case 1:
                $result="POR PAGAR";
                break;
        }
        return $result;
    }

    public function getEstadoLabel(){
        $result="";
        switch($this->estado){
            case 3: 
                $result="label-success";
                break;
            case 2: 
                $result="label-success";
                break;                
            case 1:
                $result="bg-maroon";
                break;
        }
        return $result;
    }
}
