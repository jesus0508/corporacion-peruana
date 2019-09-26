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

}
