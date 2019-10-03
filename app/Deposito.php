<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
	protected $table = 'depositos';
    protected $fillable= ['monto','detalle','codigo_operacion',
    'fecha_reporte','banco','cuenta_id'];

     	public function cuenta(){
        return $this->belongsTo(Cuenta::class);
    }
}
