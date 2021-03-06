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
            'monto_total_pago'=>'required|numeric|gt:0',
            'pendiente_dejado'=>'required|numeric', 
            'observacion'=>'max: 255',
            'fecha_pago'=>'date_format:"d/m/Y"'
           
            // 'transportista_id' =>'required|numeric',
        ];
    }
}
