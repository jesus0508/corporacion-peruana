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
            'ruc' => 'required|min: 11|unique:grifos,ruc,' . $this->id,
            'razon_social' => 'required',
            'telefono' => 'nullable|regex:/^([9]{1})([0-9]{8})$/i',
            'administrador' => 'required',
            'direccion' => 'required|max: 255|min: 5',
            'distrito' => 'required|max: 255|min: 5',
            'stock' => 'numeric',
        ];
    }
}
