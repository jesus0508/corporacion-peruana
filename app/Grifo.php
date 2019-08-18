<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class Grifo extends Model
{
    //
    protected $table = 'grifos';
    protected $fillable= ['ruc','razon_social','telefono','administrador','stock','direccion','distrito'];

}
