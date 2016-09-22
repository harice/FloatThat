<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\DealRepository;
use App\Repositories\InviteRepository;
use App\Repositories\UserRepository;
use App\Http\Requests\SendFacebookInvitesRequest;


use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Auth;

use Twitter;

class InviteController extends Controller {

    public function __construct(DealRepository $deals,
                                InviteRepository $invites,
                                UserRepository $users)
    {
        parent::__construct();

        $this->invites = $invites;
        $this->deals = $deals;
        $this->users = $users;
    }

    public function load_more_twitter_friends(Request $request) {
        $cursor = $request->query("cursor");
        $twNickname = $request->session()->get('twitter_nickname', false);

        $ids = Twitter::getFriendsIds([
            'screen_name' => $twNickname,
            'count' => 100,
            'cursor' => $cursor
        ]);

        $users = Twitter::getUsersLookup([
            'user_id' => join(",", $ids->ids)
        ]);

        $friends = [];
        foreach ($users as $user) {
            $friends[] = [
                'id' => $user->id,
                'name' => $user->name,
                'picture' => $user->profile_image_url
            ];
        }

        $data = [
            'friends' => $friends,
            'next' => url("invite/load_more_twitter_friends") . "?cursor=" . $ids->next_cursor
        ];

        return response()->json($data);
    }

    public function twitter_friends(Request $request, $float_id, $cursor = 0) {
        $this->middleware('auth');

        $deal = $this->deals->getById($float_id);
        if (!$deal) {
            abort(404);
        }

        $data = [];
        $isConnected = false;
        $friends = [];
        $next = "";

        $user = $this->users->getById(Auth::user()->id);

        //$twToken = $request->session()->get('twitter_token', false);
        $twNickname = $request->session()->get('twitter_nickname', false);
        $twToken = $user->twitter_token;
        $twTokenSecret = $user->twitter_token_secret;

        if ($twToken) {
            $isConnected = true;
        }

        if ($isConnected) {
            Twitter::reconfig([
                'token' => $twToken,
                'secret' => $twTokenSecret
            ]);

            $ids = Twitter::getFriendsIds([
                'screen_name' => $twNickname,
                'count' => 100
            ]);

            $next = $ids->next_cursor;

            $users = Twitter::getUsersLookup([
                'user_id' => join(",", $ids->ids)
            ]);

            if (count($users) > 0) {
                $friends = $users;
            }
        }

        $data = [
            'deal' => $deal,
            'isConnected' => $isConnected,
            'friends' => $friends,
            'next' => $next
        ];

        return view("invites/twitter_friends", $data);
    }

    public function facebook_friends(Request $request, $float_id) {
        $this->middleware('auth');

        $deal = $this->deals->getById($float_id);
        if (!$deal) {
            abort(404);
        }

        $isConnected = false;
        $friends = [];
        $next = null;

        $user = Auth::user();
        $fbToken = $request->session()->get('facebook_token', false);

        if ($fbToken) {
            $isConnected = true;
        }

        if ($isConnected) {
            try {
                $fb = new FacebookSession($fbToken);

                $request = new FacebookRequest($fb,'GET','/me/taggable_friends');
                $response = $request->execute();
                $graphObject = $response->getGraphObject();

                $friends = $graphObject->getProperty('data')->asArray();
            } catch(FacebookRequestException $ex) {
                dd($ex);
            } catch(\Exception $ex) {
                dd($ex);
            }
        }

        $data = [
            'deal' => $deal,
            'isConnected' => $isConnected,
            'friends' => $friends,
            'next' => $next
        ];

        return view("invites/facebook_friends", $data);
    }

    public function email_friends(Request $request, $float_id) {
        $this->middleware('auth');

        $deal = $this->deals->getById($float_id);

        if (!$deal) {
            abort(404);
        }

        $data = [
            'deal'=> $deal
        ];

        return view("invites/email_friends", $data);
    }

    public function accept(Request $request, $float_id) {
        try {
            $email = $request->query("email");

            $deal = $this->deals->getById($float_id);
            $invite = $this->invites->getByEmailAndDeal($email, $deal);
            $user_id = Auth::user()->id;

            $this->invites->accept($invite->id, $user_id);
            $request->session()->put('redirect_to_payment', true);

            return redirect()
                ->action('FloatController@show', $deal)
                ->with('success', "Congratulations, You have accepted the invitation to participate in this float. You will be redirected to payment screen");

        } catch (Exception $e) {
            return redirect()
                ->action('InviteController@show', $deal)
                ->with('error', "An error ocurred while accepting this invitation, please try again later.");
        }
    }

    public function decline($float_id) {

    }

    public function show(Request $request, $float_id) {
        $email = $request->query('email');

        $deal = $this->deals->getById($float_id);
        $host = $this->users->getById($deal->user_id);

        $invite = $this->invites->getByEmailAndDeal($email, $deal);

        // deal exits
        if (!$invite) {
            abort(404);
        }

        $data = [
            'deal' => $deal,
            'host' => $host,
            'invite' => $invite
        ];

        return view("invites/show", $data);
    }

    public function send_twitter_invites(Request $request) {

        $deal = $this->deals->getById($request->get("deal"));
        $ids = $request->get("friends");

        // default response
        $success = true;
        $response_message = "All Invites successfully sent.";

        foreach($ids as $id) {

            $newInvite = [
                'user_id' => null,
                'float_id' => $deal->id,
                'sent_by' => Auth::user()->id,
                'email_address' => $id,
                'code' => str_random(40),
            ];

            try {
                // check if invitation has been already created
                $alreadyCreated = $this->invites->getByEmailAndDeal($id, $deal);

                if ($alreadyCreated) {
                    // if is already created, retrieve.
                    $invite = $alreadyCreated;
                }
                else {
                    // if not create a new one.
                    $invite = $this->invites->create($newInvite);
                }

                $base_url = url('invite/show', $deal);
                $url = $base_url . "/?code=" . $invite->code . "&email=" . $invite->email_address;

                $link = $url;

                $message = "You have a chance of winning: " . $deal->name . ". Click the link for more info: " . $link;

                Twitter::postDm([
                    'user_id' => $id,
                    'text' => $message
                ]);
            }
            catch (\Exception $e) {
                // catch empty exeption to ensure script continues running
                // record an error
                $success = false;
                $response_message = $e->getMessage();
            }
        }

        return response()->json([
            'success' => $success,
            'message' => $response_message
        ]);
    }

    public function send_email_invites(Request $request) {
        $this->middleware('auth');

        $deal = $this->deals->getById($request->input("float_id"));

        // deal exits
        if (!$deal) {
            abort(404);
        }

        // recipients list is not empty
        if ($request->input("to") == "") {
            return redirect()->action('FloatController@show', $deal)
                ->with('error', "No invites where sent, you didn't specify any email address.");
        }

        $to = explode(',', $request->input("to"));
        $sent = [];

        foreach ($to as $email) {
            $newInvite = [
                'user_id' => null,
                'float_id' => $deal->id,
                'sent_by' => Auth::user()->id,
                'email_address' => $email,
                'code' => str_random(40),
            ];

            try {
                // check if invitation has been already created
                $alreadyCreated = $this->invites->getByEmailAndDeal($email, $deal);

                if ($alreadyCreated) {
                    // if is already created, retrieve.
                    $invite = $alreadyCreated;
                }
                else {
                    // if not create a new one.
                    $invite = $this->invites->create($newInvite);
                }

                $this->invites->sendMail($invite, $deal);

                if (!$invite) throw Exception;

                $sent[] = $email;
            }
            catch (Exception $e) {
                return redirect()
                    ->action('FloatController@show', $deal)
                    ->with('Error', "An error ocurrent while sending your invites, only the following addresses were sent: " . join(", ", $sent));
            }
        }

        return redirect()
            ->action('FloatController@show', $deal)
            ->with('success', "An invite was successfully sent to: " . join(", ", $sent));

    }

    public function send_facebook_invites(SendFacebookInvitesRequest $request) {
        $ids = $request->input("friends_id");
        $fbToken = $request->session()->get('facebook_token', false);

        foreach($ids as $id) {

            try {
                $fb = new FacebookSession($fbToken);

                $request = new FacebookRequest($fb,'POST','/' + $id + '/feed', array(
                    'message' => 'Hi!!',
                ));

                $response = $request->execute();
                dd($request);

            }
            catch(FacebookRequestException $ex) {
                dd($ex);
            }
            catch(\Exception $ex) {
                dd($ex);
            }
        }
    }

    public function facebook_canvas() {
        return view("floats/facebook");
    }

    //gets the data from a URL
    private function _get_tiny_url($url)  {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

}
