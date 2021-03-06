<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFacturaProveedorRequest extends FormRequest
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
            'nro_factura_proveedor'=>'required|unique:factura_proveedors,nro_factura_proveedor,'.$this->id,
            'monto_factura'=>'required|numeric|gt: 0',
            'fecha_factura_proveedor'=>'date_format:"d/m/Y"'
        ];
    }
}
