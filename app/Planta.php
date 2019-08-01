<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use CorporacionPeru\Proveedor;

class Planta extends Model
{
    protected $table = 'plantas';
    protected $primaryKey = 'id';
    protected $fillable= ['id', 'proveedor_id','planta','direccion_planta' ,'celular_planta'];


    public function proveedor()
    {
    	//return $this->hasMany('App\PlantaModel', 'id_empleado');
    	return $this->belongsTo(Proveedor::class,'proveedor_id');
    } 



    
}
