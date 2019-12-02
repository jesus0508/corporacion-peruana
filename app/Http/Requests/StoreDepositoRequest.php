<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepositoRequest extends FormRequest
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
            'codigo_operacion' => 'required|unique:depositos,codigo_operacion,'.$this->id,
            'fecha_reporte'=>'date_format:"d/m/Y"',
            'monto' => 'required|numeric|gte: 0',
            'detalle' => 'max: 255',
            'cuenta_id' => 'required|numeric|gt:0',
        ];
    }
}
