<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGrifoRequest extends FormRequest
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
         
            'razon_social' => 'required',
            'telefono' => 'nullable|regex:/^([9]{1})([0-9]{8})$/i',
            'ruc' => 'nullable|min: 11',
            'administrador' => 'required|max: 255',
            'direccion' => 'nullable|max: 255|min: 5',
            'distrito' => 'nullable|max: 255',
            'stock' => 'nullable|numeric|between: 0,99999.99',
            'zona' => 'required',
        ];
    }
}
