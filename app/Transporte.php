<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class Transporte extends Model
{
    protected $table = 'transportes';
    protected $fillable = ['tipo','placa','chofer'];
    protected $dates = ['deleted_at'];

    public function ingresosTranporte(){
    	return $this->hasMany(IngresoTransporte::class);
    }

    public function egresosTranporte(){
    	return $this->hasMany(EgresoTransporte::class);
    }

    public function getTipo(){
        $result="";
        switch($this->tipo){
        	case 4: 
                $result="Administrativo";
                break;
        	case 3: 
                $result="Cisternas";
                break;
            case 2: 
                $result="Buses";
                break;
            case 1:
                $result="Autos";
                break;
        }
        return $result;
    }
}
