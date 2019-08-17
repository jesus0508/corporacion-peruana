<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrabajadorRequest extends FormRequest
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
            //
            'dni'=>'required|digits: 8|unique:trabajadores,dni,'.$this->id,
            'nombres'=>'required|min: 2',
            'apellido_paterno'=>'required|min: 2',
            'apellido_materno'=>'required|min: 2',
            'telefono'=>'nullable|regex:/^([9]{1})([0-9]{8})$/i',
            'genero'=>'required',
            'email'=>'nullable|email|unique:trabajadores,email,'.$this->id,
            'direccion'=>'max: 255',
            'fecha_nacimiento'=>'nullable|date_format:"d/m/Y"',
        ];
    }
}
