<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class CategoriaGasto extends Model
{
    protected $table = 'categoria_gastos';
    protected $fillable= ['codigo','categoria'];

    public function subCategoriaGastos(){
        return $this->hasMany(SubCategoriaGasto::class);
    }
}
