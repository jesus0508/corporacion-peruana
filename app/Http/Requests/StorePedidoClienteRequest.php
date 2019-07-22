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
            'nro_pedido'=>'required|unique:pedido_clientes,nro_pedido,'.$this->id,
            'grifo'=>'min: 3|max: 255|required',
            'scop'=>'min: 3|max: 15|required',
            'galones'=>'numeric|required',
            'planta'=>'required',
            'horario_descarga'=>'max: 255',
            'observacion'=>'max: 255'
        ];
    }
}
