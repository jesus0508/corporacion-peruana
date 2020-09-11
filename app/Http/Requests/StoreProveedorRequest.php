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
            'razon_social'=>'required|max: 255',
            'ruc' => 'required|digits: 11|unique:proveedores,ruc,'.$this->id,
            'email'=>'nullable|email|unique:proveedores,email,'.$this->id,  
            'linea_credito'=> 'numeric|gt:0|lt:50000', 
            'sobregiro' => 'numeric|gt:0|lt:10000'       
            ];
    }
}
