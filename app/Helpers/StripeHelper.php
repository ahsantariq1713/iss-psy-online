<?php

namespace App\Helpers;

use App\Models\ReservedSession;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Stripe\Stripe;

class StripeHelper
{
    public static function checkout($client,$therapist,$start_date,$end_date){
         //clear previoys reserved sessions
         ReservedSession::where(['client_id' => $client->id])->delete();
         $token = Str::random(32);

         //create new reserved session and assign a token
         //attach the client and therapist to the reserved session
         $reserved = new ReservedSession([
             'start_date' => $start_date,
             'end_date' => $end_date,
             'client_id' => $client->id,
             'therapist_id' => $therapist->id,
         ]);
         $reserved->token = Hash::make($token);
         $reserved->save();

         //create a stripe session
         Stripe::setApiKey(env('STRIPE_KEY'));
         $session = \Stripe\Checkout\Session::create([
             'payment_method_types' => ['card'],
             'line_items' => [[
                 'price_data' => [
                     'currency' => 'usd',
                     'product_data' => [
                         'name' => 'Consultation Fee',
                     ],
                     'unit_amount' => $therapist->pricing->transferAmount()
                 ],
                 'quantity' => 1,
             ]],
             'payment_intent_data' => [
                 'application_fee_amount' => $therapist->pricing->platformCommission(),
                 'on_behalf_of' => $therapist->stripe_acc_id,
                 'transfer_data' => [
                     'destination' => $therapist->stripe_acc_id,
                 ],
             ],
             'mode' => 'payment',
             'success_url' => route('booking-confirmed', ['token' => $token, 'reserved_id' => $reserved->id]),
             'cancel_url' => route('booking-failed',['reserved_id' => $reserved->id]),
         ]);
         //store session id in reserved session record
         $reserved->session_id = $session->id;
        //  $reserved->session_id = Str::random(16);
         $reserved->save();
        //temporarily ro redirect to booking confirmed directly
        // return redirect()->route('booking-confirmed', ['token' => $token, 'reserved_id' => $reserved->id]);
        return $session->id;
    }
}
