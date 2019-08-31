<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePedidoProveedorClienteRequest extends FormRequest
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
            'grifero'=>'nullable|max: 255',
            'faltante' => 'required|numeric|gt:0',
            'descripcion'=>'nullable|max: 255'       
            ];
    }
}
