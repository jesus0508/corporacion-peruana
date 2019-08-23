<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class Grifo extends Model
{
    //
    protected $table = 'grifos';
    protected $fillable = ['ruc', 'razon_social', 'telefono', 'administrador', 'stock', 'direccion', 'distrito'];

    public function ingresoGrifos()
    {
        return $this->hasMany(IngresoGrifo::class);
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
