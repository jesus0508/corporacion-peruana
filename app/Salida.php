<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Salida extends Model
{
	protected $table = 'salidas';
    protected $fillable= ['monto_egreso','fecha_egreso','fecha_reporte','detalle','codigo_operacion','cuenta_id', 'banco','categoria_egreso_id','nro_comprobante','nro_cheque'];

    public function cuenta()
    {
    	return $this->belongsTo(Cuenta::class);
    } 
    public function categoria()
    {
    	return $this->belongsTo(CategoriaEgreso::class);
    } 

    public function setFechaEgresoAttribute($value){
        $this->attributes['fecha_egreso'] = Carbon::createFromFormat('Y-m-d',$value);
    } 

    public function setFechaReporteAttribute($value){
        $this->attributes['fecha_reporte'] = Carbon::createFromFormat('Y-m-d',$value);
    } 
}
