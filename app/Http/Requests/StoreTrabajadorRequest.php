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
            'dni'=>'required|unique:trabajadores,dni',
            'nombres'=>'required',
            'apellido_paterno'=>'required',
            'apellido_materno'=>'required',
            'telefono'=>'',
            'genero'=>'required',
            'email'=>'',
            'direccion'=>'',
            'fecha_nacimiento'=>'',
        ];
    }
}
