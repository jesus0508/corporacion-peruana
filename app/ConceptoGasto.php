<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class ConceptoGasto extends Model
{
    protected $table = 'concepto_gastos';
    protected $fillable= ['codigo','concepto','sub_categoria_gasto_id'];

    public function subCategoriaGasto(){
        return $this->belongsTo(SubCategoriaGasto::class);
    }

    public function egreso(){
        return $this->hasMany(Egreso::class);
    }
}
