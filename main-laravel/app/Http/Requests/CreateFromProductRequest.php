<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class CreateFromProductRequest extends FormRequest {

    public function rules()
    {
        return [
            'product_id'  => 'exists:products,id',
            'name'        => 'required',
            'price'       => 'required|numeric|min:1',
            'description' => 'required',
            'type'        => 'required',
            'ods'         => 'required|integer|max:250|min:2',
            'start_date'  => 'required|date_format:Y-m-d',
            'end_date'    => 'required|date_format:Y-m-d'
        ];
    }

    public function authorize()
    {
        return Auth::check();
    }

}
