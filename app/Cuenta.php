<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
	protected $table = 'cuentas';
    protected $fillable= ['fecha_apertura','nro_cuenta','fondo_actual','banco_id','estado','tipo'];

   	public function banco(){
        return $this->belongsTo(Banco::class);
    }
    public function depositos(){
        return $this->hasMany(Deposito::class);
    }
    public function salidas(){
        return $this->hasMany(Salida::class);
    }
}
