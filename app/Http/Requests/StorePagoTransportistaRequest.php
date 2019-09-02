<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePagoTransportistaRequest extends FormRequest
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
            'codigo_pago'=>'required|unique:pago_transportistas,codigo_pago,'.$this->id, 
            'monto_total_pago'=>'required|numeric|gt:0',
            'pendiente_dejado'=>'required|numeric',
            'fecha_pago'=>'required',
            'observacion'=>'max: 255',
            'transportista_id' =>'required|numeric',
        ];
    }
}
