<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $table = 'series';
    protected $fillable = ['id','serie','grifo_id','nro'];
    
    public function grifo(){
    	return $this->belongsTo(Grifo::class);    	
    }

    public function ingresosGrifo(){
    	return $this->hasMany(IngresoGrifo::class);
    }
}
