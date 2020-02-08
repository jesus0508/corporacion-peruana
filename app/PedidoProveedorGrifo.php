<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PedidoProveedorGrifo extends Model
{
    protected $table = 'pedido_grifos';
    protected $primaryKey = 'id';
    protected $fillable= ['faltante','grifero','pago_transportista_id','descripcion',
    		'fecha_descarga','precio_galon_faltante' ];
    
    public function grifo(){
        return $this->belongsTo(Grifo::class);
    }

    public function getFechaDescargaAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }

}
