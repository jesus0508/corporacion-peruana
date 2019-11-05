<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIngresoTransporteRequest extends FormRequest
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
            'monto_ingreso'=>'required|numeric|gt:0',
            'fecha_reporte'=>'date_format:"d/m/Y"',
            'fecha_ingreso'=>'date_format:"d/m/Y"',
        ];
    }
}
