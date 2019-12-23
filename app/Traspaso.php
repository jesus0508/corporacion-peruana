<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class Traspaso extends Model
{
   	protected $table = 'transportistas';
    protected $primaryKey = 'id';
    protected $fillable= ['id','grifo_id_sender' ,
    				 'grifo_id_receiver','fecha_traspaso'];


}
