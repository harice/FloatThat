<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Facebook\FacebookSession;
use Auth;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

    public function __construct() {
        FacebookSession::setDefaultApplication(
            env('FACEBOOK_CLIENT_ID'),
            env('FACEBOOK_CLIENT_SECRET')
        );

        // if logged in an no email field entered, redirect to save email screen.
        if (!Auth::guest()) {
            $user = Auth::user();

            if (!$user->email) {
                return redirect()->route('askemail')->withMessage("Float coul not be created")->send();
            }
        }

    }

}
