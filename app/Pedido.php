<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $fillable= ['id','nro_pedido','scop', 
    							'galones', 'costo_galon','estado' , 'saldo' , 
    							'factura_proveedor_id','vehiculo_id','planta_id'];


    public function planta(){
        return $this->belongsTo(Planta::class);
    }

    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class);
    }

    public function pedidosCliente(){
        return $this->belongsToMany(PedidoCliente::class,'pedido_proveedor_clientes')->with('pedidos');
    }

    public function facturaProveedor(){
        return $this->belongsTo(FacturaProveedor::class);
    }

    
    public function getGalonesStock(){
        return $this->galones-$this->galones_distribuidos;
    }

    public function getPrecioTotal(){
        return $this->costo_galon*$this->galones;
    }

    public function setFechaDescargaAttribute($value){ 
        $this->attributes['fecha_descarga']=Carbon::createFromFormat('d/m/Y',$value)->format('Y-m-d');
    }

    public function hasntFactura(){
        return $this->factura_proveedor_id==null;
    }

    public function hasntVehiculo(){
        return $this->vehiculo_id==null;
    }

    public function isConfirmed(){
        return $this->estado==2;
    }

    public function isUnconfirmed(){
        return $this->estado==1;
    }

    public function isPaid(){
        return $this->estado==3;    
    }							
}
