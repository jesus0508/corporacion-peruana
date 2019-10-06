<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class CategoriaEgreso extends Model
{
	protected $table = 'categoria_egresos';
    protected $fillable= ['categoria'];

    public function pagoProveedores(){
    	return $this->hasMany(PagoProveedor::class);
    }
    public function egresos(){
        return $this->hasMany(Salida::class);
    }
}
