<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class PagoTransportista extends Model
{
    //pago_transportistas
    protected $table = 'pago_transportistas';
    protected $fillable= ['fecha_pago','observacion','codigo_pago','monto_total_pago','pendiente_dejado'];
    

}
