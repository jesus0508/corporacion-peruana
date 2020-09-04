<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
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
            'ruc' => 'required|size: 11|unique:clientes,ruc,' . $this->id,
            'razon_social' => 'required|max: 120',
            'cargo'=>'nullable|min:3|max:50',
            'representante'=>'nullable|min:2|max:100',
            'dni'=>'nullable|size:8',
            'correo_cliente'=>'nullable|email',
            'actividad_economica'=>'nullable|max:255',
            'precio_galon'=>'required|numeric|gt:0|lt:1000',
            'linea_credito'=>'required|numeric|gt:0|lt:100000',
            'distrito'=>'required|max:255',
            'telefono'=>'nullable|min:7|max:9',
            'direccion'=>'required|min:5|max:255',
            'forma_pago'=>'required|min:5|max:255',
            'persona_comision'=>'nullable|min:5|max:100',
            'correo_representante'=>'nullable|email',
            'nro_cuenta'=>'nullable|max:255',
            'cuenta_detraccion'=> 'nullable|max:255',
            'utilidades'=>'nullable|max:255',
            'extraordinaria'=>'nullable|max:255'
        ];
    }



}
