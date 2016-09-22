<?php namespace App\Repositories;

use App\Deal;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Auth;
use Mail;

class DealRepository {

    public function getAll() {
        /*return Deal::where('start_date', '>', $now)
            ->where('end_date', '<', $now)
            ->get();*/

        return Deal::all();
    }

    public function getOpen() {
        return Deal::open()->get();
    }

    public function getFeatured() {
        return Deal::open()
            ->orderByRaw("RAND()")
            ->take(4)
            ->get();
    }

    public function getUserDeals() {
        return Deal::userDeals()->get();
    }

    public function getUserBought($user_id) {
        return Deal::Join("payments", function($join) use ($user_id) {
            $join->on("deals.id", "=", "payments.float_id")
                 ->where("payments.user_id", "=", $user_id)
                 ->where("payments.status", "=", "COMPLETED");
        })->get();
    }

    public function getById($deal_id) {
        return Deal::find($deal_id);
    }

    public function create($dealData) {
        return Deal::create($dealData);
    }

    public function updateImage($deal, $imagePath) {
        $deal = Deal::find($deal->id);
        $deal->image_path = $imagePath;
        $deal->save();
    }

    public function markCompleted($deal_id) {
        $deal = Deal::find($deal_id);

        $deal->completed = true;
        $deal->save();
    }

    public function setPublished($deal_id) {
        $deal = Deal::find($deal_id);

        $deal->status = 0;
        $deal->save();
    }

    public function getRandom($count) {
        return Deal::open()->orderByRaw("RAND()")->take($count)->get();
    }

    public function postOnFacebook($deal, $fbToken) {
        $message = "A chance of winning: " . $deal->name . ". Click the link for more info: " . url("float/share", $deal);

        $fb = new FacebookSession($fbToken);
        $request = new FacebookRequest(
            $fb,
            'POST',
            '/me/feed',
            array (
                'message' => $message,
                'link' => url("float/share", $deal)
            )
        );

        $response = $request->execute();
        $graphObject = $response->getGraphObject();

        return true;
    }

    public function sendBoughtEmail(Deal $deal, $winner, $email) {
        $data = [
            'deal' => $deal,
            'winner' => $winner,
            'float_url' => url('float', $deal),
        ];

        Mail::send('emails.deal_bought', $data, function($m) use ($email) {
            $m->from("noreply@floatthat.com", "Floatthat.com")
              ->to($email)
              ->subject('Congratulations!');
        });
    }

}
