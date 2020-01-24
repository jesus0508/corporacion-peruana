<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PagoTransportista extends Model
{
    //pago_transportistas
    protected $table = 'pago_transportistas';
    protected $fillable= ['monto_total_pago','pendiente_dejado',
    						'observacion','fecha_pago'];
    

    public function setFechaPagoAttribute($value){ 
        $this->attributes['fecha_pago'] = Carbon::createFromFormat('d/m/Y',$value);
    }

    public function getFechaPagoAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }

}
