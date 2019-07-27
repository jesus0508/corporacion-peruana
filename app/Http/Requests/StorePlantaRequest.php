<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlantaRequest extends FormRequest
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
            //'razon_social'=>'required|max: 255|unique:proveedores,razon_social,'.$this->id,
            'planta'=>'required|max: 255',
            'direccion_planta' => 'required|max: 255',
            'celular_planta'=>'max: 9',
            'proveedor_id' => 'required',
            
      
        ];
    }
}
