<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePagoProveedorRequest extends FormRequest
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
            'codigo_operacion'=>'required|max: 255|unique:pago_proveedors,codigo_operacion,'.$this->id,
            'banco'=>'required|max: 255',
            'monto_operacion'=>'required|numeric|gt: 0',
            'fecha_operacion'=>'date_format:"d/m/Y"',
            'fecha_reporte'=>'date_format:"d/m/Y"',

        ];
    }
}
