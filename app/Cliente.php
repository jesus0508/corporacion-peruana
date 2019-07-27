<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;
    protected $table = 'clientes';
    protected $fillable= ['ruc','razon_social','tipo','direccion','telefono'];
    protected $dates = ['deleted_at'];

    public function pedidoClientes(){
        return $this->hasMany(PedidoCliente::class);
    }
}
