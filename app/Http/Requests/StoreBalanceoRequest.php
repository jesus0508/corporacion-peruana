<?php

namespace CorporacionPeru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBalanceoRequest extends FormRequest
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
            'grifo_id_sender' => 'required|numeric|gt:0',
            'grifo_id_receiver' => 'required|numeric|gt:0',
            'grifo_sender_stock_nuevo' => 'required|numeric|gte:0',
            'grifo_receiver_stock_nuevo' => 'required|numeric|gte:0',
            'cantidad'=> 'required|numeric|gt:0',
            'fecha'=> 'required'
        ];
    }
}
