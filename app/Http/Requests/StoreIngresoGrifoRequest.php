<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIngresoGrifoRequest extends FormRequest
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
            'lectura_inicial'=>'required|numeric|gt: 0',
            'lectura_final'=>'required|numeric|gt: 0',
            'calibracion'=>'required|numeric|gt: 0',
            'precio_galon'=>'required|numeric|gt:0',
            'fecha_ingreso'=>'required',
            'grifo_id'=>'required'
        ];
    }
}
