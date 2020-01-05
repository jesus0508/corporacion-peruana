<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class PedidoProveedorGrifo extends Model
{
    protected $table = 'pedido_grifos';
    protected $primaryKey = 'id';
    protected $fillable= ['faltante','grifero','pago_transportista_id','descripcion',
    		'fecha_descarga','precio_galon_faltante' ];

}
