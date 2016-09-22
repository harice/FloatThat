<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\DealRepository;
use App\Repositories\ProductRepository;
use App\Repositories\InviteRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\UserRepository;
use App\Http\Requests\CreateDealRequest;
use App\Http\Requests\CreateFromProductRequest;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Api\Capture;
use PayPal\Api\Authorization;

use Auth;
use URL;
use Config;
use Redirect;
use Session;

class FloatController extends Controller {

    private $_api_context;

    public function __construct(DealRepository $deals,
                                ProductRepository $products,
                                InviteRepository $invites,
                                PaymentRepository $payments,
                                UserRepository $users)
    {
        parent::__construct();

        $this->deals = $deals;
        $this->products = $products;
        $this->invites = $invites;
        $this->payments = $payments;
        $this->users = $users;

        $this->middleware('auth');
    }

    public function index() {
        $deals = $this->deals->getOpen();

        $data = [
            'deals' => $deals
        ];

        return view("floats/index", $data);
    }

    public function create(Request $request) {
        $products = $this->products->getActive();

        $data = [
            'fbToken' => $request->session()->get('facebook_token'),
            'products' => $products
        ];

        return view("floats/create", $data);
    }

    public function show(Request $request, $float_id) {
        $deal = $this->deals->getById($float_id);

        if (!$deal) {
            abort(404);
        }

        $others = $this->deals->getRandom(4);
        $invites = $this->invites->getFloatInvites($float_id);
        $paid_payments = $this->payments->getFloatPaidPayments($float_id);
        $buttons_disabled = false;
        $organizer = $this->users->getById($deal->user_id);

        // this shouldnt  belong here. ugly HACK. no time to fix. NO TIME. I SAID.
        // if requested to be published on facebook, publish.
        $fbPost = $request->session()->get("facebook_publish");
        if ($fbPost) {
            $fbToken = $request->session()->get('facebook_token', false);
            $this->deals->postOnFacebook($deal, $fbToken);

            $request->session()->forget('facebook_publish');
        }

        $accepted = [];
        $pending = [];
        $declined = [];

        foreach ($invites as $invite) {
            if ($invite->accepted == true)
                $accepted[] = $invite;

            else if ($invite->accepted == false && $invite->declined == false)
                $pending[] = $invite;

            else if ($invite->accepted == false && $invite->declined == true)
                $declined[] = $invite;
        }

        $accepted_invite = $this->invites->hasAcceptedInvite($deal->id, Auth::user()->id);

        $data = [
            'organizer' => $organizer,
            'deal'=> $deal,
            'others' => $others,
            'invites' => $invites,
            'accepted' => $accepted,
            'pending' => $pending,
            'declined' => $declined,
            'accepted_invite' => $accepted_invite,
            'paid_payments' => $paid_payments,
            'buttons_disabled' => $buttons_disabled,
            'redirect_to_payment' => $request->session()->get('redirect_to_payment')
        ];

        $request->session()->forget('redirect_to_payment');
        return view("floats/show", $data);
    }

    public function add(CreateDealRequest $request) {
        $newDeal = [
            'user_id' => Auth::user()->id,
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'description'  => $request->get('description'),
            'ods' => $request->get('ods'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'status' => 0, // 2 is pending payment, 0 is active, 1 is completed
            'type' => $request->get('type'), // invite only?
        ];

        $deal = $this->deals->create($newDeal);
        $file = $request->file('image');

        if ($deal && $file->isValid()) {
            $extension = $file->getClientOriginalExtension();
            $imageName = $deal->id . '.' . $extension;
            $imagePath = '/public/';

            $file->move(base_path() . $imagePath, $imageName);
            $this->deals->updateImage($deal, '/float_images/' . $imageName);

            // post on facebook
            $fbPost = $request->get('facebook_publish');
            if ($fbPost) {
                $fbToken = $request->session()->get('facebook_token', false);
                $this->deals->postOnFacebook($deal, $fbToken);
            }

            return redirect()->route('getdeal', [$deal]);
        }

        return redirect()->back()
            ->WithInput()->withMessage("Float coul not be created");
    }

    public function create_from_product(Request $request, $product_id) {
        $product = $this->products->getById($product_id);
        if (!$product) { abort(404); }

        $data = [
            'fbToken' => $request->session()->get('facebook_token'),
            'product' => $product
        ];

        return view("floats/create_from_product", $data);
    }

    public function add_from_product(CreateFromProductRequest $request) {
        $product = $this->products->getById($request->product_id);

        $newDeal = [
            'user_id' => Auth::user()->id,
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'description'  => $request->get('description'),
            'ods' => $request->get('ods'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'status' => 2, // 2 is pending payment, 0 is active, 1 is completed
            'type' => $request->get('type'),
            'from_product' => true
        ];

        $deal = $this->deals->create($newDeal);

        if ($deal) {
            $this->deals->updateImage($deal, $product->image_path);

            // create payment and send user to payment screen (paypal)
            $redirect_url = $this->_createPayment($request, $deal);

            // post on facebook
            $fbPost = $request->get('facebook_publish');
            if ($fbPost) {
                $request->session()->put('facebook_publish', $fbPost);
            }

            return redirect()->away($redirect_url);
        }

        return redirect()->back()
            ->WithInput()->withMessage("Float coul not be created");
    }

    private function _createPayment($request, $deal) {
        // setup PayPal api context
        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));

        $this->_api_context->setConfig($paypal_conf['settings']);

        $intent = 'authorize';
        $return_url = URL::route('payment.ifPaidPublishFloat');
        $payment_type = 0; // type 0 means payment IS NOT buynow
        $total_price = round($deal->price/$deal->ods, 2);

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();
        $item_1->setName($deal->name) // item name
               ->setCurrency('USD')
               ->setQuantity(1)
               ->setPrice($total_price); // unit price

        // add item to list
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
               ->setTotal($total_price);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
                    ->setItemList($item_list)
                    ->setDescription($deal->description);

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl($return_url) // Specify return URL
            ->setCancelUrl(URL::route('createdeal'));

        $payment = new Payment();
        $payment->setIntent($intent)
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {

            // create payment row on database
            $newPayment = [
                'user_id' => Auth::user()->id,
                'float_id' => $deal->id,
                'amount' => $request->price,
                'type' => $payment_type,
                'success' => false,
                'status' => 'CREATE_FAILED'
            ];
            $newPayment = $this->payments->create($newPayment);

            if (\Config::get('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('Some error occurred, sorry for inconvenient');
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        // create payment row on database
        $newPayment = [
            'user_id' => Auth::user()->id,
            'float_id' => $deal->id,
            'amount' => $total_price,
            'type' => $payment_type,
            'success' => true,
            'status' => 'CREATED'
        ];
        $newPayment = $this->payments->create($newPayment);

        // add payment ID to session
        $request->session()->put('paypal_payment_id', $payment->getId());
        $request->session()->put('payment_id', $newPayment->id);

        return $redirect_url;
    }

}
