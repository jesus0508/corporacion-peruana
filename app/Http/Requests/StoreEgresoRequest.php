<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEgresoRequest extends FormRequest
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
            'concepto_gasto_id' => 'required|numeric|gt: 0',
            'fecha_egreso'=>'date_format:"d/m/Y"',
            'fecha_reporte'=>'date_format:"d/m/Y"',
            'monto_egreso' => 'required|numeric|gte: 0',
            'grifo_id'=> 'required|numeric|gt: 0',

        ];
    }
}
