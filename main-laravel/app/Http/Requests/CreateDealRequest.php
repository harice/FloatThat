<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class CreateDealRequest extends FormRequest {

    public function rules()
    {
        return [
            'name'        => 'required',
            'description' => 'required',
            'type'        => 'required',
            'price'       => 'required|numeric|min:1',
            'ods'         => 'required|integer|max:250|min:2',
            'start_date'  => 'required|date_format:Y-m-d',
            'end_date'    => 'required|date_format:Y-m-d',
            'image'       => 'mimes:jpeg,png|required'
        ];
    }

    public function authorize()
    {
        return Auth::check();
    }

}
