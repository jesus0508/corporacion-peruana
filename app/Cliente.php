<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $fillable= ['ruc','razon_social','telefono','tipo','direccion'];
}
