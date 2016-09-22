<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ConfirmUserRequest extends FormRequest {

    public function rules()
    {
        return [
            'name'       => 'required',
            'avatar'    => 'required',
            'email'      => 'required|email',
        ];
    }

    public function authorize()
    {
        return true;
    }

}
