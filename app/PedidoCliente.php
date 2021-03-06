<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class PedidoCliente extends Model
{
    use SoftDeletes;
    protected $table = 'pedido_clientes';
    protected $fillable = [
        'galones', 'horario_descarga', 'estado', 'saldo', 'fecha_confirmacion',
        'precio_galon', 'planta', 'observacion', 'fecha_descarga', 'cliente_id', 'factura_cliente_id'
    ];
    protected $dates = ['deleted_at'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function categoriaIngreso(){
        return $this->belongsTo(CategoriaIngreso::class);
    }

    public function pagoClientes()
    {
        return $this->belongsToMany(PagoCliente::class);
    }

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'pedido_proveedor_clientes');
    }

    public function facturaCliente()
    {
        return $this->belongsTo(FacturaCliente::class);
    }

    public function getPrecioTotal()
    {
        return round($this->precio_galon * $this->galones,2);
    }

    public function galonesXasignar()
    {
        return $this->galones - $this->galones_asignados;
    }

    public function setFechaDescargaAttribute($value)
    {
        if (!is_null($value)) {
            $this->attributes['fecha_descarga'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');    
        }
    }

    public function getFechaDescargaAttribute($value)
    {
        if (is_null($value))
            return null;
        else
            return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }

    public function isUnconfirmed()
    {
        return $this->estado == 1;
    }

    public function isConfirmed()
    {
        return $this->estado == 2;
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
