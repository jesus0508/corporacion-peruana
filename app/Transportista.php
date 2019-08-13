<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class Transportista extends Model
{
   	protected $table = 'transportistas';
    protected $primaryKey = 'id';
    protected $fillable= ['id','ruc','nombre_transportista' ,'celular_transportista'];


    public function vehiculos()
    {
    	
    	return $this->hasMany(Vehiculo::class, 'transportista_id');
}

}
