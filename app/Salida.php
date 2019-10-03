<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
	protected $table = 'salidas';
    protected $fillable= ['monto_egreso','fecha_egreso','fecha_reporte','detalle','codigo_operacion','cuenta_id', 'banco','categoria_egreso_id'];

    public function cuenta()
    {
    	return $this->belongsTo(Cuenta::class,);
    } 
    public function categoria()
    {
    	return $this->belongsTo(CategoriaEgreso::class,);
    } 
}
