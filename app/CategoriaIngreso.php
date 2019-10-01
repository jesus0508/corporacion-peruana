<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class CategoriaIngreso extends Model
{
    protected $table = 'categoria_ingresos';
    protected $fillable= ['id','categoria'];

    public function ingresos(){
        return $this->hasMany(Ingreso::class);
    }

    public function pagoClientes(){
    	return $this->hasMany(PagoCLiente::class);
    }

    public function ingresoGrifos(){
    	return $this->hasMany(IngresoGrifo::class);
    }
}
