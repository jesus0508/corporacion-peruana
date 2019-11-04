<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCancelacionRequest extends FormRequest
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
            'nro_operacion' => 'required|max: 255|unique:cancelacions,nro_operacion,'.$this->id,
            'fecha' => 'required|date_format:"d/m/Y"',
            'monto' => 'required|numeric|gt:0',
            'facturacion_grifo_id'=> 'required',
        ];
    }
}
