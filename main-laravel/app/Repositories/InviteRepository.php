<?php namespace App\Repositories;

use App\Invite;
use App\Deal;
use App\User;
use App\Winner;
use App\Payment;
use Mail;
use Auth;

class InviteRepository {

    public function getAll() {
        /*return Deal::where('start_date', '>', $now)
          ->where('end_date', '<', $now)
          ->get();*/

        return Invite::all();
    }

    public function create($invite) {
        return Invite::create($invite);
    }

    public function getByUserIdAndDeal($float_id, $user_id) {
        return Invite::where('float_id', $float_id)
            ->where('user_id', $user_id)
            ->first();
    }

    public function getUserSent($user_id) {
        return Invite::where('invites.sent_by', $user_id)
            ->join("deals", "deals.id", "=", "invites.float_id")
            ->get();
    }

    public function getUserInvites($user_id) {
        return Invite::where('invites.user_id', $user_id)
            ->join("deals", "deals.id", "=", "invites.float_id")
            ->get();
    }

    public function getFloatInvites($float_id) {
        return Invite::where('float_id', $float_id)->get();
    }

    public function getFloatAcceptedInvites($float_id) {
        return Invite::where('float_id', $float_id)
            ->where('accepted', true)
            ->get();
    }

    public function getByEmailAndDeal($email, $deal) {
        return Invite::where('float_id', $deal->id)
            ->where('email_address', $email)
            ->first();
    }

    public function hasAcceptedInvite($float_id, $user_id) {
        $invite = Invite::where('float_id', $float_id)
            ->where('user_id', $user_id)
            ->where('accepted', true)
            ->where('declined', false)
            ->first();

        if ($invite)
            return true;
        else
            return false;
    }

    public function accept($invite_id, $user_id) {
        $invite = Invite::find($invite_id);

        $invite->accepted = true;
        $invite->user_id = $user_id;

        $invite->save();
    }

    public function sendMail($invite, $deal) {
        $data = [
            'deal' => $deal,
            'invite' => $invite,
            'base_url' => url('invite/show', $deal),
            'float_url' => url('float', $deal),
            'host' => Auth::user(),
        ];

        Mail::send('emails.invitation', $data, function ($m) use ($invite) {
            $m->from("noreply@floatthat.com", "Floatthat.com")
              ->to($invite->email_address)
              ->subject('You got a change of winning');
        });
    }

    public function sendFloatCompleted(Deal $deal, User $winner) {
        $payments = Payment::authorized()
            ->where('float_id', $deal->id)
            ->get();

        $data = [
            'deal' => $deal,
            'winner' => $winner,
            'float_url' => url('float', $deal),
        ];

        // loop thru payments and notify them is over.
        foreach($payments as $payment) {
            // skip winner, he gets its own email
            if ($winner->user_id == $payment->user_id) continue;

            // This is SLOW. TEMP FIX.
            // Should be using a JOIN instead of fetching each loop.
            $user = User::find($payment->user_id);
            Mail::send('emails.deal_ended', $data, function($m) use ($user) {
                $m->from("noreply@floatthat.com", "Floatthat.com")
                  ->to($user->email)
                  ->subject('We have a winner!');
            });
        }
    }

    public function sendwinner(Deal $deal, User $winner, $email) {
        $data = [
            'deal' => $deal,
            'winner' => $winner,
            'float_url' => url('float', $deal),
        ];

        Mail::send('emails.deal_winner', $data, function($m) use ($email) {
            $m->from("noreply@floatthat.com", "Floatthat.com")
              ->to($email)
              ->subject('We have a winner!');
        });
    }

}
