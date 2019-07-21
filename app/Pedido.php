<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $fillable= ['nro_pedido','planta','scop','fecha_despacho', 
    							'galones', 'costo_galon','estado' , 'saldo' , 'nro_factura','pago_acta','fecha_pago'];
}
