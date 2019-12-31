<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TrasladoGalones extends Model
{
   	protected $table = 'traslado_galones';
    protected $primaryKey = 'id';
    protected $fillable= ['tipo','id','stock','nuevo_stock','cantidad',
				'horario','proveedor_id','cliente_id','fecha','grifo_id'];

    public function proveedor()
    {    	
    	return $this->belongsTo(Proveedor::class, 'proveedor_id');
	}

    public function grifo()
    {       
        return $this->belongsTo(Grifo::class);
    }

    public function cliente()
    {       
        return $this->belongsTo(Cliente::class);
    } 

    public function setFechaAttribute($value)
    {
        $this->attributes['fecha'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }
    public function getFechaAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }

    public function getTipo(){
    	
    	$result="";

        switch($this->tipo){
            case 2: 
                $result="Cliente";
                break;
            case 1:
                $result="Grifo";
                break;
        }
        return $result;
    }
}
