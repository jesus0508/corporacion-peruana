<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class PedidoCliente extends Model
{
    use SoftDeletes;
    protected $table = 'pedido_clientes';
    protected $fillable= ['nro_pedido','grifo','galones','horario_descarga', 'estado',
                            'precio_galon', 'planta' , 'observacion','fecha_descarga',
                            'cod_osinergmin','cod_cliente','usuario_osinerming'];
    protected $dates = ['deleted_at'];
                            
    public function getPrecioTotal(){
        return $this->precio_galon*$this->galones;
    }

    public function setFechaDescargaAttribute($value){ 
        $this->attributes['fecha_descarga']=Carbon::createFromFormat('d/m/Y',$value)->format('Y-m-d');
    }

    public function isConfirmed(){
        return $this->estado==2;
    }

    public function isUnconfirmed(){
        return $this->estado==1;
    }
}
