<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIngresoRequest extends FormRequest
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
            'monto_ingreso'=>'required|numeric|gt:0',
            'fecha_reporte'=>'required|date_format:"d/m/Y"',
            'fecha_ingreso'=>'required|date_format:"d/m/Y"',
            'detalle' => 'nullable|max:255',
            'codigo_operacion'=> 'nullable|max:255|unique:ingresos,codigo_operacion,' . $this->id,
            'banco' => 'nullable|max:255',
            'categoria_ingreso_id' => 'required|numeric|gt:0'
        ];
    }
}
