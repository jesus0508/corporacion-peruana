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
            'cliente_id'=>'required|numeric',
            'grifo'=>'required|min: 3|max: 255',
            'galones'=>'required|numeric|gt:0',
            'precio_galon'=>'required|numeric|gt:0',
            'saldo'=>'required|numeric|gt:0',
            'fecha_descarga'=>'date_format:"d/m/Y"',
            'horario_descarga'=>'max: 255',
            'observacion'=>'max: 255'
        ];
    }
}
