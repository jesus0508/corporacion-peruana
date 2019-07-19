<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $fillable= ['planta','razon_social','representante','celular'];
}
