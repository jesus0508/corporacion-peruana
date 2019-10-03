<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    protected $table = 'bancos';
    protected $fillable= ['banco','abreviacion','empresa_id'];

    public function empresa(){
        return $this->belongsTo(Empresa::class);
	}

    public function cuentas(){
        return $this->hasMany(Cuenta::class);
	}
}
