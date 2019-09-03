<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class SubCategoriaGasto extends Model
{
    protected $table = 'sub_categoria_gastos';
    protected $fillable= ['codigo','subcategoria','categoria_gasto_id'];

    public function categoriaGasto(){
        return $this->belongsTo(CategoriaGasto::class);
    }

    public function conceptoGastos(){
        return $this->hasMany(ConceptoGasto::class);
    }

}
