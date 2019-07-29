<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class Tranportista extends Model
{
   	protected $table = 'transportistas';
    protected $primaryKey = 'id';
    protected $fillable= ['id','razon_social','ruc' ,'representante'];


    public function vehiculos()
    {
    	
    	return $this->hasMany(Vehiculo::class, 'transportista_id');
}
