<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $fillable= ['id','nro_pedido','scop', 
    							'galones', 'costo_galon','estado' , 'saldo' ,
                                'chofer', 'costo_flete', 'brevete_chofer', 
                                'fecha_pedido','pedido_extraordinario',
    							'factura_proveedor_id','vehiculo_id','planta_id'];


    public function planta(){
        return $this->belongsTo(Planta::class);
    }

    public function getMonto(){
        $monto = $this->costo_galon*$this->galones;
        return round($monto,2);
    }

    public function facturaProveedor(){
        return $this->belongsTo(FacturaProveedor::class);
    }

    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class);
    }

    public function pedidoProveedorClientes(){
        return $this->hasMany(PedidoProveedorCliente::class);
    }

    public function pedidoProveedorGrifos(){
        return $this->hasMany(PedidoProveedorGrifo::class);
    }

    public function pedidosCliente(){
        return $this->belongsToMany(PedidoCliente::class,'pedido_proveedor_clientes')->with('pedidos');
    }

    public function setFechaPedidoAttribute($value)
    {
        $this->attributes['fecha_pedido'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getFechaPedidoAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }
    public function grifos(){
        return $this->belongsToMany(Grifo::class,'pedido_grifos');
    }

    public function pagosProveedor(){
        return $this->belongsToMany(PagoProveedor::class,'pago_pedido_proveedors');
    }
    
    public function pagoPedidoExtraordinario(){
        return $this->belongsToMany(Pedido::class,
            'pago_proveedor_extraordinario' ,'pedido_id' ,'pedido_extraordinario_id');
    }

    public function getGalonesStock(){
        return $this->galones-$this->galones_distribuidos;
    }

    public function getPrecioTotal(){
        return $this->costo_galon*$this->galones;
    }


    public function hasntFactura(){
        return $this->factura_proveedor_id==null;
    }

    public function hasntVehiculo(){
        return $this->vehiculo_id==null;
    }

    public function isUnconfirmed(){
        return $this->estado==1;
    }  
    
    public function isConfirmed(){
        return $this->estado==2;
    }

    public function isDistributed()
    {
        return $this->estado == 3;
    }

    public function isAmortized()
    {
        return $this->estado == 4;
    }

    public function isPaid()
    {
        return $this->estado == 5;
    }							
}
