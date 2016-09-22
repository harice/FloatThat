<?php namespace App\Repositories;

use App\User;
use Auth;

class UserRepository {

    public function create($user) {
        return User::create($user);
    }

    public function update($user, $data) {
        User::where('id', $user->id)
                               ->update($data);

        return User::find($user->id);
    }

    public function FindbyEmail($email) {
        return User::where('email', $email)->first();
    }

    public function getByID($user_id) {
        return User::find($user_id);
    }

    public function getLogged() {
        return User::find(Auth::user()->id);
    }

    public function FindByTwitter($twitterId) {
        // avoid null email var
        //$email = (is_null($userData->email) ? "" : $userData->email);
        $user = User::where('twitter_provider_id', $twitterId)->first();
        return $user;
    }

    public function FindByFacebook($fbId) {
        $user = User::where('facebook_provider_id', $fbId)->first();
        return $user;
    }

    public function FindByEmailOrCreate($userData) {
        $user = User::where('email', $userData->email)->first();

        if ($user) return $user;

        return User::create([
            'email' => $userData->email,
            'name' => $userData->name,
            'avatar' => $userData->avatar,
            'facebook_provider_id' => $userData->id,
        ]);
    }

    public function updateemail($email, $user_id) {
        $user = User::find($user_id);
        $user->email = $email;
        return $user->save();
    }

    public function confirmEmail($confirmation_code) {
        $user = User::where('confirmation_code', $confirmation_code)->first();

        if (!$user) {
            return null;
        }

        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();

        return $user;
    }

}
