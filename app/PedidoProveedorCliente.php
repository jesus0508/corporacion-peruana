<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class PedidoProveedorCliente extends Model
{
    protected $table = 'pedido_proveedor_clientes';
    protected $primaryKey = 'id';
    protected $fillable= ['faltante','grifero','descripcion' ];


}
