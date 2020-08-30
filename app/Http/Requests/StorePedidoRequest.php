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
            'nro_pedido'=>'required|lte:999999999|unique:pedidos,nro_pedido,'.$this->id,
            'scop'=>'required|regex:/^[1-9]{1}[0-9]{12}/|unique:pedidos,scop,'.$this->id,
            'planta_id' => 'required|numeric',         
            'galones'=>'required|numeric|gte:500|regex:/\d*[05]00/|lte:5000',
            'costo_galon'=>'required|numeric|gt:0',
            'fecha_pedido'=>'required|date_format:"d/m/Y"'
        ];
    }

    public function messages(){
        return [
            'scop.regex' => 'El SCOP debe ser un numero de 13 digitos',
            'galones.regex' => 'La cantidad de galones deben ser (500,1000,1500,...)'
        ];
    }
}
