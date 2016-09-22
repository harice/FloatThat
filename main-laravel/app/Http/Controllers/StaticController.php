<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreEmailRequest;
use App\Repositories\UserRepository;
use App\Repositories\DealRepository;
use Auth;

class StaticController extends Controller {

	  /**
	   * Create a new controller instance.
	   *
	   * @return void
	   */
    public function __construct(
        UserRepository $users,
        DealRepository $deals)
    {
        $this->users = $users;
        $this->deals = $deals;
    }

	  /**
	   * Show the application dashboard to the user.
	   *
	   * @return Response
	   */
	  public function how()
    {
        return view("how_it_works");
	  }

    public function ask_email() {
        return view("askemail");
    }

    public function store_email(StoreEmailRequest $request) {
        $email = $request->get("email");
        $this->users->updateEmail($email, Auth::user()->id);

        return redirect('/')->with('success', 'Profile updated!');
    }

    public function show_shareable($float_id) {
        $deal = $this->deals->getById($float_id);

        $data = [
            'deal'=> $deal
        ];


        return view("floats/shared", $data);
    }


}
