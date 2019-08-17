<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePagoRequest extends FormRequest
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
            'fecha_operacion'=>'required|date_format:"d/m/Y"',
            'codigo_operacion'=>'required',
            'monto_operacion'=>'required|numeric|gt: 0',
            'saldo'=>'required|numeric',
            'banco'=>'required|max: 255',
            'pedido_cliente_id'=>'required'
        ];
    }
}
