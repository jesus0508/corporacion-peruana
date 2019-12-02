<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ingreso extends Model
{
    protected $table = 'ingresos';
    protected $fillable= ['monto_ingreso','fecha_reporte','fecha_ingreso','detalle','codigo_operacion', 'banco','categoria_ingreso_id'];

    public function categoriaIngreso(){
        return $this->belongsTo(CategoriaIngreso::class);
    }

    public function setFechaIngresoAttribute($value){
        $this->attributes['fecha_ingreso'] = Carbon::createFromFormat('d/m/Y',$value);
    } 

    public function setFechaReporteAttribute($value){
        $this->attributes['fecha_reporte'] = Carbon::createFromFormat('d/m/Y',$value);
    } 
}
