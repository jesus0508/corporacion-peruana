<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class PedidoCliente extends Model
{
    protected $table = 'pedido_clientes';
    protected $fillable= ['nro_pedido','grifo','galones','horario_descarga', 'scop', 
                            'transportista' , 'planta' , 'observacion','fecha_pedido',
                            'cod_osinergmin','cod_cliente','usuario_osinerming'];
}
