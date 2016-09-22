<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class PaymentRequest extends FormRequest {

    public function rules()
    {
        return [
            'float_id' => 'required',
            'is_final' => 'required',
            'description' => 'required',
            'price'       => 'required|numeric|min:0',
            'quantity'    => 'required|numeric',
            'transaction_description' => 'required',
            'original_url' => 'required'
        ];

    }

    public function authorize()
    {
        return Auth::check();
    }

}
