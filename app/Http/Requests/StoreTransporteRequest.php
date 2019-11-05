<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransporteRequest extends FormRequest
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
            'chofer'=>'string|max: 255',
            'tipo' => 'required|numeric|gt:0',
            'placa' => 'required|min: 6|alpha-dash|unique:transportes,placa,'.$this->id,
        ];
    }
}
