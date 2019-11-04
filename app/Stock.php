<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stock';
    protected $fillable= ['stock_general','stock_reserva'];

    public function getTotal(){
    	return $this->stock_general+$this->stock_reserva;
    }
}
