<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use CorporacionPeru\Planta;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $primaryKey = 'id';
    protected $fillable= ['id','razon_social','ruc' , 'deuda' ,'representante', 'email'];


    public function plantas()
    {
    	//return $this->hasMany('App\PlantaModel', 'id_empleado');
    	return $this->hasMany(Planta::class,'proveedor_id');
    } 
}

