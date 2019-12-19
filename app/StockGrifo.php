<?php

namespace CorporacionPeru;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class StockGrifo extends Model
{
    protected $table = 'stock_grifos';
    protected $fillable= ['lectura_inicial','lectura_final','calibracion','venta_soles',
    			'precio_galon','fecha_stock','traspaso','recepcion',
    			'horario_pecsa','cantidad_pecsa', 'stock_sistema','stock_grifo',
    			'horario_primax', 'cantidad_primax',
    			'horario_pbf', 'cantidad_pbf',
    			'grifo_id'];


    public function grifos()
    {
        return $this->belongsTo(Grifo::class);
    }
    public function setFechaStockAttribute($value){
        
        $this->attributes['fecha_stock'] = Carbon::createFromFormat('d/m/Y',$value);
    } 

    public function getFechaStockAttribute($value){
        
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }

    public function getGalones(){
        return $this->lectura_final-$this->lectura_inicial-$this->calibracion;
    }

    public function getDiferencia(){
        return $this->stock_grifo-$this->stock_sistema;
    }
    public function getNewStock(){
        return $this->stock_sistema-$this->traspaso
        +$this->recepcion + $this->cantidad_primax
        +$this->cantidad_pbf + $this->cantidad_pbf;
    }
    public function getHorario(){
    	
    	$result="";

        switch($this->horario){
        	case 5:
        		$result= "Prefactura";
        		break;
        	case 4: 
                $result="Propio Flete";
                break;
        	case 3: 
                $result="Tercer Viaje";
                break;
            case 2: 
                $result="Segundo Viaje";
                break;
            case 1:
                $result="Primer Viaje";
                break;
        }
        return $result;
    }
}
