<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class TrasladoGalones extends Model
{
   	protected $table = 'traslado_galones';
    protected $primaryKey = 'id';
    protected $fillable= ['tipo','id','stock','nuevo_stock','cantidad',
				'horario','proveedor_id'];


    public function proveedor()
    {
    	
    	return $this->belongsTo(Proveedor::class, 'proveedor_id');
	}

    public function getTipo(){
    	
    	$result="";

        switch($this->tipo){
            case 2: 
                $result="CLiente";
                break;
            case 1:
                $result="GRifo";
                break;
        }
        return $result;
    }
}
