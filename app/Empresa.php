<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';
    protected $fillable= ['razon_social','ruc','direccion'];


    public function bancos(){
        return $this->hasMany(Banco::class);
	}
}
