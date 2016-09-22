<?php namespace App\Http\Controllers;

use App\Repositories\DealRepository;

class WelcomeController extends Controller {

    /*
      |--------------------------------------------------------------------------
      | Welcome Controller
      |--------------------------------------------------------------------------
      |
      | This controller renders the "marketing page" for the application and
      | is configured to only allow guests. Like most of the other sample
      | controllers, you are free to modify or remove it as you desire.
      |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DealRepository $deals) {
        $this->middleware('guest');

        $this->deals = $deals;
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index() {
        $deals = $this->deals->getFeatured();

        $data = [
            'deals' => $deals
        ];

        return view('welcome', $data);
    }

}
