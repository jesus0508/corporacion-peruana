<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFacturacionGrifoRequest extends FormRequest
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
            'grifo_id' => 'required|numeric|gt:0',
            'fecha_facturacion' => 'required|date_format:"d/m/Y"',
            'serie_id' => 'required|numeric|gt:0',
            'numero_factura'=> 'nullable|max:255',
            'venta_factura'=> 'nullable|numeric|gt: 0',
            'venta_boleta'=> 'nullable|numeric|gt: 0',
            'precio_venta'=> 'required|numeric|min:0|not_in:0',
        ];
    }
}
