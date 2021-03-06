<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class Grifo extends Model
{
    //
    protected $table = 'grifos';
    protected $fillable = ['ruc', 'razon_social','correo_grifo', 'precio_galon' ,
        'telefono', 'administrador', 'stock', 'direccion', 'distrito','zona','dni',
    'forma_pago','persona_comision','correo_representante' , 'nro_cuenta','cuenta_detraccion','utilidades','extraordinaria'];

    public function ingresoGrifos()
    {
        return $this->hasMany(IngresoGrifo::class);
    }

    public function stock_grifos(){
        return $this->hasMany(StockGrifo::class);
    }

    public function series(){
        return $this->hasMany(Serie::class);
    }

    public function latestIngresoGrifos()
    {
        return $this->hasOne(IngresoGrifo::class)->latest();
    }

    public function latest($column = 'fecha_ingreso')
    {
        return $this->orderBy($column, 'desc');
    }
}
