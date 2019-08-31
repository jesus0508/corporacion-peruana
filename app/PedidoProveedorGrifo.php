<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class PedidoProveedorGrifo extends Model
{
    protected $table = 'pedido_grifos';
    protected $primaryKey = 'id';
    protected $fillable= ['faltante','grifero','descripcion' ];

}
