<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;
    protected $table = 'clientes';
    protected $fillable= ['ruc','razon_social','tipo','direccion','telefono','linea_credito','periocidad'];
    protected $dates = ['deleted_at'];

    public function pedidoClientes(){
        return $this->hasMany(PedidoCliente::class);
    }

    public function getTipo(){
        $result="";
        switch($this->tipo){
            case 1: 
                $result="Grifo";
                break;
            case 2:
                $result="Normal";
                break;
        }
        return $result;
    }
}
