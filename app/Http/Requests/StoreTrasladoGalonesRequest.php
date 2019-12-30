<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrasladoGalonesRequest extends FormRequest
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
            'tipo'=>'required|numeric|gt:0',
            'stock'=>'required|numeric|gte:0',
            'nuevo_stock'=>'required|numeric|gte:0',
            'cantidad'=>'required|numeric|gte:0',
            'horario'=>'required|max:20',
            'proveedor_id'=>'required|numeric|gt:0'
        ];
    }
}
