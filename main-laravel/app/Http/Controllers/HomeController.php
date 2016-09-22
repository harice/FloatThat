<?php namespace App\Http\Controllers;

use App\Repositories\DealRepository;
use App\Repositories\UserRepository;
use App\Repositories\InviteRepository;

use Facebook\FacebookSession;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmailRequest;

use Auth;

class HomeController extends Controller {

	  /**
	   * Create a new controller instance.
	   *
	   * @return void
	   */
    public function __construct(DealRepository $deals,
                                UserRepository $users,
                                InviteRepository $invites)
    {
        parent::__construct();

        $this->deals = $deals;
        $this->users = $users;
        $this->invites = $invites;

        $this->middleware('auth');
    }

	  /**
	   * Show the application dashboard to the user.
	   *
	   * @return Response
	   */
	  public function index(Request $request) {
        $current_user = Auth::user();

        $user_deals = $this->deals->getUserDeals();
        $user = $this->users->getLogged();
        $bought_deals = $this->deals->getUserBought($current_user->id);
        $user_invites = $this->invites->getUserInvites($current_user->id);
        $user_sent_invites = $this->invites->getUserSent($current_user->id);

        $data = [
            'user_deals' => $user_deals,
            'bought_deals' => $bought_deals,
            'user_invites' => $user_invites,
            'user_sent_invites' => $user_sent_invites,
            'user' => $user
        ];

        return view("home", $data);
	  }
}
