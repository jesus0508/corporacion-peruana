<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePedidoRequest extends FormRequest
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
            'nro_pedido'=>'required|unique:pedidos,nro_pedido,'.$this->id,
            'scop'=>'required|unique:pedidos,scop,'.$this->id,
            'planta_id' => 'required|numeric',         
            'galones'=>'required|numeric|gt:0',
            'costo_galon'=>'required|numeric|gt:0',
        ];
    }
}
