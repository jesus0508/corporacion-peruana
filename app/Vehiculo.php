<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'vehiculos';
    protected $primaryKey = 'id';
    protected $fillable= ['id', 'transportista_id','placa','tipo' ,'modelo','marca'];


    public function transportistas()
    {
    	
    	return $this->belongsTo(Proveedor::class,'transportista_id');
    } 
}
