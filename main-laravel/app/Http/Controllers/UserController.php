<?php
namespace App\Http\Controllers;
use App\Http\Requests\LoginUserRequest;


use Illuminate\Support\Facades\Auth;

class UserController extends Controller {

    public function authenticate(LoginUserRequest $request) {
        $return = array("status" => 200, "message" => "Successfully logged in.");

        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'confirmed' => 1
        ];

        if (!Auth::attempt($credentials)) {
            $return = array("status" => 401, "message" => "Invalid Credentials. Please try again.");
        }

        return $return;
    }
}
