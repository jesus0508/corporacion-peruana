<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class Transporte extends Model
{
    protected $table = 'transportes';
    protected $fillable = ['tipo','placa','chofer'];
    protected $dates = ['deleted_at'];
}
