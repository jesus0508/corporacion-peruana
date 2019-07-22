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
            'nro_pedido'=>'required|unique:pedidos',
            'grifo'=>'required',
            'scop'=>'required',
            'galones'=>'required',
            'planta'=>'required',
            'horario_descarga'=>'required',
            'observacion'=>'required'
        ];
    }
}
