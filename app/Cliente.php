<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;
    protected $table = 'clientes';
    protected $fillable= ['ruc','razon_social','direccion','cargo','representante',
    'dni','telefono','correo_cliente','actividad_economica','precio_galon',
        'linea_credito', 'distrito','direccion','forma_pago','persona_comision','correo_representante' , 'nro_cuenta','cuenta_detraccion','utilidades','extraordinaria'];
    protected $dates = ['deleted_at'];

    public function pedidoClientes(){
        return $this->hasMany(PedidoCliente::class);
    }

    public function getFormaPago(){
        $result="";
        switch($this->tipo){

            case 4: 
                $result="Mensual";
                break;
            case 3: 
                $result="Quincenal";
                break;
            case 2: 
                $result="Semanal";
                break;
            case 1:
                $result="Diario";
                break;
        }
        return $result;
    }
}
