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
            'planta'=>'required|max: 255|unique:plantas,planta,'.$this->id,
            'direccion_planta' => 'nullable|max: 255',
            'celular_planta'=>'nullable|regex:/^([9]{1})([0-9]{8})$/i',
            'proveedor_id' => 'required',
            
      
        ];
    }
}
