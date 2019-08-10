<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Trabajador extends Model
{
    //
    protected $table = 'trabajadores';
    protected $fillable=[
        'dni','nombres','apellido_paterno','apellido_materno','fecha_nacimiento',
        'telefono','genero','email','direccion'
    ];

    public function user()
    {
    	return $this->hasOne(User::class,'trabajador_id');
    }

    public function hasAccount()
    {
    	return $this->user!=null;
    }

    public function setFechaNacimientoAttribute($value){ 
        $this->attributes['fecha_nacimiento']=Carbon::createFromFormat('d/m/Y',$value)->format('Y-m-d');
    }

    public function getFechaNacimientoAttribute($value){ 
        return $value ? Carbon::createFromFormat('Y-m-d',$value)->format('d/m/Y') : $value;
    }
}
