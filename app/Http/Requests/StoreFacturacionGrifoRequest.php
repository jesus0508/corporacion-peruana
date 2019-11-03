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
            'grifo_id' => 'required',
            'fecha_facturacion' => 'required|date_format:"d/m/Y"',
            'series'=> 'required|max:255',
            'nro_factura'=> 'nullable|max:255',
            'venta_factura'=> 'nullable|numeric|gt: 0',
            'venta_boleta'=> 'nullable|numeric|gt: 0',
            'precio_venta'=> 'required|numeric|gt: 0',
        ];
    }
}
