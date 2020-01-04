<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class Balanceo extends Model
{
   	protected $table = 'balanceos';
    protected $primaryKey = 'id';
    protected $fillable= ['id','grifo_id_sender' ,'grifo_sender_stock_nuevo',
    				'grifo_receiver_stock_nuevo',
    				'grifo_id_receiver','fecha','cantidad'];

    public function grifoReceiver(){
    	$this->belongsTo(Grifo::class,'grifo_id_receiver');
    }

    public function grifoSender(){
    	$this->belongsTo(Grifo::class,'grifo_id_sender');
    } 
}
