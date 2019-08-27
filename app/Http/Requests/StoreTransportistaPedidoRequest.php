<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransportistaPedidoRequest extends FormRequest
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
            'brevete_chofer' => 'max: 255',
            'vehiculo_id'=>'required|numeric',
            'costo_flete' =>'required|numeric|gt:0'
        ];
    }
}
