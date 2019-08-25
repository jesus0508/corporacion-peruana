<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
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
            'ruc' => 'required|min: 11|unique:clientes,ruc,' . $this->id,
            'telefono' => 'nullable|regex:/^([9]{1})([0-9]{8})$/i',
            'razon_social' => 'required',
            'direccion' => 'max: 255|min: 5',
            'linea_credito' => 'required|numeric|gt:0',
        ];
    }
}
