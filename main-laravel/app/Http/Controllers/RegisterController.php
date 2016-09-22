<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Http\Requests\RegisterUserRequest;

use Hash;
use Mail;

class RegisterController extends Controller {

    public function __construct(UserRepository $users) {
        $this->users = $users;
    }

    public function store(RegisterUserRequest $request) {
        $confirmation_code = str_random(30);

        $newUser = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'confirmation_code' => $confirmation_code
        ];

        $this->users->create($newUser);

        $data = [
            'confirmation_code' => $confirmation_code
        ];

        Mail::send('emails.verify', $data, function($message) use ($request) {
            $message->from("noreply@floatthat.com", "Floatthat.com")
                ->to($request->input('email'), $request->input('name'))
                ->subject('Verify your email address');
        });

        return redirect()
            ->route('/')
            ->with('success', "Thanks for signing up! Please check your email.");
    }

    public function confirm($confirmation_code) {
        if (!$confirmation_code) {
            throw new InvalidConfirmationCodeException;
        }

        $user = $this->users->confirmEmail($confirmation_code);

        if (!$user) {
            throw new InvalidConfirmationCodeException;
        }

        return redirect()
            ->to('auth/login')
            ->with('success', "You have successfully verified your account.");
    }
}
