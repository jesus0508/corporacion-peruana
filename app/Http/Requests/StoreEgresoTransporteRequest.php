<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEgresoTransporteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
         return [
            'transporte_id'=> 'required|numeric|gt:0',
            'monto_egreso'=>'required|numeric|gt:0',
            'fecha_reporte'=>'date_format:"d/m/Y"',
            'fecha_egreso'=>'date_format:"d/m/Y"',
            'tipo_comprobante' => 'required|numeric|gt:0',
            'nro_comprobante' => 'required|unique:egreso_transportes,nro_comprobante,'.$this->id,
            'descripcion' =>'required|max: 255',

        ];
    }
}
