<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePagoBloqueRequest extends FormRequest
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
            'fecha_operacion'=>'required|date_format:"d/m/Y"',
            'codigo_operacion'=>'nullable',
            'fecha_reporte'=>'required|date_format:"d/m/Y"', 
            'monto_operacion'=>'required|numeric|gt: 0',
            'banco'=>'required|max: 255',
        ];
    }
}
