<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

use App\Repositories\UserRepository;
use App\Repositories\DealRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\WinnerRepository;
use App\Repositories\InviteRepository;
use App\Http\Requests\PaymentRequest;

use Config;
use URL;
use Session;
use Redirect;
use Auth;

class PaypalController extends Controller {

    private $_api_context;

    public function __construct(UserRepository $users,
                                DealRepository $deals,
                                PaymentRepository $payments,
                                WinnerRepository $winners,
                                InviteRepository $invites)
    {
        parent::__construct();

        $this->middleware('auth');

        // setup PayPal api context
        $paypal_conf = Config::get('paypal');

        $this->users = $users;
        $this->deals = $deals;
        $this->payments = $payments;
        $this->winners = $winners;
        $this->invites = $invites;

        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));

        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function postPayment(PaymentRequest $request) {
        $deal = $this->deals->getById($request->float_id);

        if (!$deal) {
            abort(404);
        }

        // is it floatpay or buy now?
        $intent = 'authorize';
        $return_url = URL::route('payment.status');
        $payment_type = 0; // type 0 means payment IS NOT buynow

        if ($request->is_final) {
            $intent = 'sale';
            //$return_url = URL:route('payment.status.buynow');
            $payment_type = 1;
        }

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();
        $item_1->setName($request->description) // item name
            ->setCurrency('USD')
            ->setQuantity($request->quantity)
            ->setPrice($request->price); // unit price

        // add item to list
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->price);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription($request->transaction_description);

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl($return_url) // Specify return URL
            ->setCancelUrl($request->original_url);

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
            'amount' => $request->price,
            'type' => $payment_type,
            'success' => true,
            'status' => 'CREATED'
        ];
        $newPayment = $this->payments->create($newPayment);

        // add payment ID to session
        $request->session()->put('paypal_payment_id', $payment->getId());
        $request->session()->put('payment_id', $newPayment->id);

        if(isset($redirect_url)) {
            // redirect to paypal
            return Redirect::away($redirect_url);
        }

        return Redirect::to($request->original_url)
            ->with('error', 'Unknown error occurred');
    }

    public function ifPaidPublishFloat(Request $request) {
        // Get the payment ID before session clear
        $paypal_payment_id = $request->session()->get('paypal_payment_id');
        $payment_id = $request->session()->get('payment_id');

        $payment = $this->payments->getbyId($payment_id);

        // clear the session payment ID
        $request->session()->forget('paypal_payment_id');
        $request->session()->forget('payment_id');

        if (empty($request->query('PayerID')) || empty($request->query('token'))) {
            return redirect()->action('FloatController@show', $payment->float_id)
                             ->with('error', 'Payment failed, please try again');
        }

        $paypal_payment = Payment::get($paypal_payment_id, $this->_api_context);

        $execution = new PaymentExecution();
        $execution->setPayerId($request->query('PayerID'));

        //Execute the payment
        $result = $paypal_payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
            $this->deals->setPublished($payment->float_id);

            // get authorization id
            $authorization_id = '';
            if ($payment->type == 0) {
                $transactions = $paypal_payment->getTransactions();
                $relatedResources = $transactions[0]->getRelatedResources();
                $authorization = $relatedResources[0]->getAuthorization();
                $authorization_id = $authorization->getId();
            }

            // create payment row on database
            $newPayment = [
                'user_id' => Auth::user()->id,
                'float_id' => $payment->float_id,
                'amount' => $payment->amount,
                'type' => $payment->type,
                'success' => true,
                'status' => 'AUTHORIZED',
                'authorization' => $authorization_id
            ];

            $newPayment = $this->payments->create($newPayment);

            return redirect()->action('FloatController@show', $payment->float_id);

        }
        else {
            return redirect()->action('FloatController@create')
                             ->with('error', 'Payment failed, please try again');
        }
    }

    public function getPaymentStatus(Request $request) {

        // Get the payment ID before session clear
        $paypal_payment_id = $request->session()->get('paypal_payment_id');
        $payment_id = $request->session()->get('payment_id');

        $payment = $this->payments->getbyId($payment_id);

        // clear the session payment ID
        $request->session()->forget('paypal_payment_id');
        $request->session()->forget('payment_id');

        if (empty($request->query('PayerID')) || empty($request->query('token'))) {
            return redirect()->action('FloatController@show', $payment->float_id)
                ->with('error', 'Payment failed, please try again');
        }

        $paypal_payment = Payment::get($paypal_payment_id, $this->_api_context);

        $execution = new PaymentExecution();
        $execution->setPayerId($request->query('PayerID'));

        //Execute the payment
        $result = $paypal_payment->execute($execution, $this->_api_context);

        $authorization_id = '';
        if ($payment->type == 0) {
            $transactions = $paypal_payment->getTransactions();
            $relatedResources = $transactions[0]->getRelatedResources();
            $authorization = $relatedResources[0]->getAuthorization();
            $authorization_id = $authorization->getId();
        }

        if ($result->getState() == 'approved') {
            // create payment row on database
            $newPayment = [
                'user_id' => Auth::user()->id,
                'float_id' => $payment->float_id,
                'amount' => $payment->amount,
                'type' => $payment->type,
                'success' => true,
                'status' => $payment->type ? 'COMPLETED' : 'AUTHORIZED',
                'authorization' => $authorization_id
            ];

            $newPayment = $this->payments->create($newPayment);


            // determine which success screen to use.
            if ($payment->type == 1) {
                return redirect()->route('payment.success.buynow', $newPayment->id);
            }
            else {
                return redirect()->route('payment.success', $newPayment->id);
            }
        }

        // if failed
        // create payment row on database
        $newPayment = [
            'user_id' => Auth::user()->id,
            'float_id' => $payment->float_id,
            'amount' => $payment->amount,
            'type' => $payment->type,
            'success' => false,
            'status' => $payment->type ? 'COMPLETE_FAILED' : 'AUTHORIZE_FAILED'
        ];
        $newPayment = $this->payments->create($newPayment);

        return redirect()->route('payment.failed', $newPayment->id)
            ->with('error', 'Payment failed');
    }

    public function successBuyNow($payment_id) {
        $payment = $this->payments->getById($payment_id);

        if (!$payment) {
            abort(404);
        }

        $this->deals->markCompleted($payment->float_id);
        $deal = $this->deals->getById($payment->float_id);

        $data = [
            'deal' => $deal,
            'payment' => $payment
        ];

        // send email notification
        $this->deals->sendBoughtEmail($deal, Auth::user(), Auth::user()->email);


        return view("payments/success_buynow", $data);
    }

    public function success($payment_id) {
        $payment = $this->payments->getById($payment_id);

        if (!$payment) {
            abort(404);
        }

        $deal = $this->deals->getById($payment->float_id);
        $paid = $this->payments->getFloatPaidPayments($payment->float_id);

        if (count($paid) >= $deal->ods) {
            // capture all payments
            $captured = $this->_captureAllAuthorizedPayments($paid, $deal->id);

            if ($captured != true) {
                // not all payments could be captured
                // notify site admins something went wrong.
                dd($captured);
            }

            // generate a winner
            $winnerPayment = $this->payments->getRandomWinnerPayment($deal->id);
            $winnerUser = $this->users->getById($winnerPayment->user_id);
            $winnerEmail = $winnerUser->email;

            // save winner in db
            $winner = [
                'user_id' => $winnerUser->id,
                'float_id' => $deal->id
            ];
            $winner = $this->winners->create($winner);

            if ($winner) {
                // send float complete emails
                $this->invites->sendFloatCompleted($deal, $winnerUser);

                // send winner email
                $this->invites->sendWinner($deal, $winnerUser, $winnerEmail);

                // mark deal as completed
                $this->deals->markCompleted($deal->id);
            }
        }

        $data = [
            'payment' => $payment
        ];

        return view("payments/success", $data);
    }

    public function fail($payment_id) {
        echo "fail";
    }


    // ** HELPER FUNCTIONS ** //
    private function _captureAllAuthorizedPayments($paid, $float_id) {

        foreach ($paid as $payment) {
            $amount = new Amount();
            $amount->setCurrency("USD");
            $amount->setTotal($payment->amount);

            $capture = new Capture();
            $capture->setId($payment->authorization);
            $capture->setAmount($amount);
            $capture->setIsFinalCapture(true);

            //dd($capture);
            try {
                $authorization = Authorization::get($payment->authorization, $this->_api_context);
                $capt = $authorization->capture($capture, $this->_api_context);

                if ($capt->getState() == 'completed') {
                    // create payment row on database
                    $newPayment = [
                        'user_id' => $payment->user_id,
                        'float_id' => $payment->id,
                        'amount' => $payment->amount,
                        'type' => 0, // type 0 means payment IS NOT buynow
                        'success' => true,
                        'status' => 'COMPLETED',
                        'authorize' => $payment->authorize
                    ];
                    $newPayment = $this->payments->create($newPayment);
                }
            }
            catch (Exception $e) {
                // create payment row on database
                $newPayment = [
                    'user_id' => $payment->user_id,
                    'float_id' => $payment->id,
                    'amount' => $payment->amount,
                    'type' => 0, // type 0 means payment IS NOT buynow
                    'success' => false,
                    'status' => 'COMPLETE_FAIL',
                    'authorize' => $payment->authorize
                ];
                $newPayment = $this->payments->create($newPayment);

                return $capt;
            }
        }

        // if everything ok return true
        return true;
    }

}
