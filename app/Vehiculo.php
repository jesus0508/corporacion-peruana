<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'vehiculos';
    protected $primaryKey = 'id';
    protected $fillable= ['id', 'transportista_id','placa','detalle_compartimiento' ,'capacidad'];


    public function transportista()
    {
    	
    	return $this->belongsTo(Transportista::class,'transportista_id');
    } 
}
