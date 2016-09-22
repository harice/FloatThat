<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Requests\ConfirmUserRequest;
use App\Http\Requests\LoginUserRequest;

use Redirect;
use Socialite;
use Validator;
use App\User;
use Auth;
use Twitter;
use Session;

class AuthController extends Controller {

    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
    */

    use AuthenticatesAndRegistersUsers;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
        $this->middleware('guest', ['except' => [
            'getLogout',
            'twitter',
            'twitter_redirect',
            'facebook',
            'facebook_redirect']
        ]);
    }

    public function getLogout() {
        Session::flush();
        return Redirect::to("/");
    }

    public function postLogin(LoginUserRequest $request) {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'confirmed' => 1
        ];

        if (!Auth::attempt($credentials)) {
            return Redirect::back()
                ->withInput()
                ->withErrors([
                    'credentials' => 'We were unable to sign you in.'
                ]);
        }

        return redirect()->intended("home");
    }


    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function confirm_save(ConfirmUserRequest $request) {
        $userData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'avatar' => $request->input('avatar'),
            'twitter_provider_id' => $request->input('twitter_provider_id', ""),
            'facebook_provider_id' => $request->input('facebook_provider_id', "")
        ];

        $user = $this->users->FindByEmail($request->input('email'));

        if ($user) {
            // update
            $newUser = $this->users->update($user, $userData);
        }
        else {
            // create
            $newUser = $this->users->create($userData);
        }

        $request->session()->forget('twitter_provider_id');
        $request->session()->forget('facebook_provider_id');
        $request->session()->forget('name');
        $request->session()->forget('email');

        Auth::login($newUser, true);
        return redirect()->intended("home");
    }

    public function confirm(Request $request) {
        $twitter_id  = $request->session()->get("twitter_id", "");
        $facebook_id = $request->session()->get("facebook_id", "");

        $data = [];

        $data['name'] = $request->session()->get("name", "");
        $data['email'] = $request->session()->get("email", "");
        $data['facebook_provider_id'] = $facebook_id;
        $data['twitter_provider_id'] = $twitter_id;
        $data['twitter_nickname'] = $request->session()->get("twitter_nickname");
        $data['avatar'] = $request->session()->get("avatar", "");

        return view("users/confirm", $data);
    }

    /** TWITTER LOGIN **/
    public function twitter(Request $request) {
        // your SIGN IN WITH TWITTER  button should point to this route
        $sign_in_twitter = true;
        $force_login = false;

        // Make sure we make this request w/o tokens,
        // overwrite the default values in case of login.
        Twitter::reconfig(['token' => '', 'secret' => '']);
        $token = Twitter::getRequestToken(route('twitter.callback'));

        if (isset($token['oauth_token_secret'])) {
            $url = Twitter::getAuthorizeURL($token, $sign_in_twitter, $force_login);
            $redirectUrl = $request->get("redirectUrl");

            Session::put('oauth_state', 'start');
            Session::put('oauth_request_token', $token['oauth_token']);
            Session::put('oauth_request_token_secret', $token['oauth_token_secret']);
            Session::put('redirectUrl', $redirectUrl);

            return Redirect::to($url);
        }

        return Redirect::route('twitter.error');
        //return Socialite::with('twitter')->redirect();
    }

    public function twitter_redirect(Request $request) {

        if (Session::has('oauth_request_token')) {
            $request_token = [
                'token'  => Session::get('oauth_request_token'),
                'secret' => Session::get('oauth_request_token_secret'),
            ];

            Twitter::reconfig($request_token);
            $oauth_verifier = false;

            if ($request->has('oauth_verifier')) {
                $oauth_verifier = $request->input('oauth_verifier');
            }

            $token = Twitter::getAccessToken($oauth_verifier);
            if (!isset($token['oauth_token_secret'])) {
                return Redirect::route('twitter.login')
                    ->with('flash_error', 'We could not log you in on Twitter.');
            }

            $credentials = Twitter::getCredentials();

            if (is_object($credentials) && !isset($credentials->error)) {
                Session::put('access_token', $token);
                Session::put('twitter_nickname', $credentials->screen_name);

                $user = $this->users->getById(Auth::user()->id);
                $data = [
                    'twitter_provider_id' => $credentials->id,
                    'twitter_token' => $token['oauth_token'],
                    'twitter_token_secret' => $token['oauth_token_secret']
                ];
                $this->users->update($user, $data);

                $redirectUrl = Session::get('redirectUrl', "/");

                return Redirect::to($redirectUrl)
                        ->with('success',
                               'Congrats! You\'ve successfully connected your twitter account!');
            }

            return Redirect::route('/')
                ->with('flash_error',
                       'Crab! Something went wrong while signing you up!');
        }

        return redirect()->intended("home");
    }

    /** FACEBOOK LOGIN **/
    public function facebook_redirect() {
        return Socialite::with('facebook')
            ->scopes(['email', 'user_friends', 'publish_actions'])->redirect();
    }

    public function facebook(Request $request) {
        $fbUser = Socialite::with('facebook')->user();

        $request->session()->put('facebook_token', $fbUser->token);
        /*
        $user = $this->users->getById(Auth::user()->id);
        $data = [
            'facebook_provider_id' => $fbUser->id,
            'facebook_token' => $fbUser->token,
        ];
        $this->users->update($user, $data);

        if ($user) {
            return Redirect::intended("home")
                ->with('flash_notice',
                       'Congrats! You\'ve successfully signed in!');
        }
        */
        return back()
            ->with('success',
                   'Congrats! You\'ve successfully connected to facebook!');
    }

}
