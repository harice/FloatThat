<?php namespace App\Repositories;

use App\Payment;

class PaymentRepository {

    public function getById($id) {
        return Payment::find($id);
    }

    public function create($paymentData) {
        return Payment::create($paymentData);
    }

    public function getFloatPaidPayments($float_id) {
        return Payment::authorized()
            ->where('float_id', $float_id)
            ->get();
    }

    public function markAsCaptured(Payment $paymentObject) {
        $payment = Payment::find($paymentObject->id);

        $payment->status = "CAPTURED";
        $payment->success = true;

        $payment->save();
    }

    public function markAsFailed(Payment $paymentObject) {
        $payment = Payment::find($paymentObject->id);

        $payment->status = "FAILED";
        $payment->success = false;

        $payment->save();
    }

    public function getRandomWinnerPayment($float_id) {
        return Payment::where("float_id", $float_id)
            ->authorized()
            ->orderByRaw("RAND()")
            ->first();
    }

}
