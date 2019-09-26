<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table = 'ingresos';
    protected $fillable= ['monto_ingreso','fecha_ingreso','detalle','codigo_operacion', 'banco','categoria_ingreso_id'];

    public function categoriaIngreso(){
        return $this->belongsTo(CategoriaIngreso::class);
    }

}
