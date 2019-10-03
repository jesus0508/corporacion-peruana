<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class CategoriaEgreso extends Model
{
	protected $table = 'categoria_egresos';
    protected $fillable= ['categoria'];
}
