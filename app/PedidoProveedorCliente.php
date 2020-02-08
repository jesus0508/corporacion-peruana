<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class PedidoProveedorCliente extends Model
{
    protected $table = 'pedido_proveedor_clientes';
    protected $primaryKey = 'id';
    protected $fillable= ['faltante','pedido_cliente_id','grifero','descripcion',
    			'pago_transportista_id','precio_galon_faltante' ];

    public function pedidoCliente(){
    	return $this->belongsTo(PedidoCliente::class);
    }
}
