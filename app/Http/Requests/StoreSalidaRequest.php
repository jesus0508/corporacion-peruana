<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalidaRequest extends FormRequest
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
            'monto_egreso'=>'required|numeric|gt:0',
            'fecha_reporte'=>'required|date_format:"d/m/Y"',
            'fecha_ingreso'=>'required|date_format:"d/m/Y"',
            'detalle' => 'nullable|max:255',
            'codigo_operacion'=> 'nullable|max:255',
            'categoria_egreso_id' => 'required|numeric|gt:0',
            'nro_cheque' => 'nullable|max:255',
            'nro_comprobante'=> 'nullable|max:255',
            'cuenta_id'=> 'nullable|numeric|gt:0'
        ];
    }
}
