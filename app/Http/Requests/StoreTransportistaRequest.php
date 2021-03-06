<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransportistaRequest extends FormRequest
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
            'nombre_transportista'=>'required|string|max: 255',
            'ruc' => 'required|numeric|digits: 11|unique:transportistas,ruc,'.$this->id,
            'celular_transportista'=>
            'nullable|regex:/^([9]{1})([0-9]{8})$/i|unique:transportistas,celular_transportista,'.$this->id,
        ];
    }
}
