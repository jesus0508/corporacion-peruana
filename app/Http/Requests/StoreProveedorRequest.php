<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProveedorRequest extends FormRequest
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
            'razon_social'=>'required|max: 255',
             'ruc' => 'required|max: 14',
            'representante'=>'max: 255',
            
      
        ];
    }
}
