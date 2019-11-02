<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use CorporacionPeru\Planta;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $primaryKey = 'id';
    protected $fillable= ['id','razon_social','ruc' , 'linea_credito','deuda' ,'representante', 'email','sobregiro'];


    public function plantas()
    {
    	return $this->hasMany(Planta::class,'proveedor_id');
    } 
}

