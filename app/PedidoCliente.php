<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class PedidoCliente extends Model
{
    protected $table = 'pedido_clientes';
    protected $fillable= ['nro_pedido','grifo','galones','horario_descarga', 'scop', 'estado',
                            'precio_galon', 'transportista' , 'planta' , 'observacion','fecha_pedido',
                            'cod_osinergmin','cod_cliente','usuario_osinerming'];
                            
    public function getPrecioTotal(){
        return $this->precio_galon*$this->galones;
    }

    public function isConfirmed(){
        return $this->estado==2;
    }

    public function isUnconfirmed(){
        return $this->estado==1;
    }
}
