<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStockGrifoRequest extends FormRequest
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
            'calibracion'=>'nullable',
            'venta_soles' => 'required|numeric|gt: 0',
            'precio_galon'=>'required|numeric|gt:0',
            'fecha_stock'=>'required|date_format:"d/m/Y"',
            'stock_grifo'=>'required|numeric|gt: 0',
            'stock_sistema'=>'required|numeric|gt: 0',                
            'traspaso'=> 'nullable|numeric|gt: 0',
            'recepcion'=> 'nullable|numeric|gt: 0',
            'cantidad_pbf'=> 'nullable|numeric|gt: 0',
            'cantidad_pecsa'=> 'nullable|numeric|gt: 0',
            'cantidad_primax'=> 'nullable|numeric|gt: 0',
            'horario_pbf'=> 'nullable|numeric|gt: 0',
            'horario_pecsa'=> 'nullable|numeric|gt: 0',
            'horario_primax'=> 'nullable|numeric|gt: 0',                    
            'grifo_id'=>'required'
        ];
    }
}
