<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePedidoClienteRequest extends FormRequest
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
            'cliente_id' => 'required|numeric',
            'galones' => 'required|numeric|gt:0',
            'precio_galon' => 'required|numeric|gt:0|lt:10000',
            'saldo' => 'required|numeric|gt:0',
            'fecha_descarga' => 'nullable|date_format:"d/m/Y"',
            'horario_descarga' => 'max: 50',
            'observacion' => 'max: 255'
        ];
    }
}
