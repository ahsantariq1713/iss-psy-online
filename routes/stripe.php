<?php

use Illuminate\Support\Facades\Route;

Route::get('/stripe-refresh', function () {

    request()->session()->flash('error', 'Stripe connect failed');
    return redirect()->route('therapist.professional-profile', ['payment']);
})->name('stripe-refresh');

Route::get('/stripe-return', function () {

    $stripe = new \Stripe\StripeClient(env('STRIPE_KEY'));
    $response = $stripe->accounts->retrieve(
        \Illuminate\Support\Facades\Auth::user()->stripe_acc_id,
    );
    if ($response->details_submitted) {
        \Illuminate\Support\Facades\Auth::user()->profileLog->update(['payment' => true]);
        request()->session()->flash('success', 'Stripe connected successfully');
        return redirect('/dashboard');
    } else {
        request()->session()->flash('error', 'Stripe connect failed');
    }
    return redirect()->route('therapist.professional-profile', ['payment']);
})->name('stripe-return');


Route::get('booking-confirmed/{token}/{reserved_id}', function ($token, $reserved_id) {
    //access the reserved session details
    $reservedSession = \App\Models\ReservedSession::find($reserved_id);

    if (is_null($reservedSession)) {
        abort(404);
    }

    //find the therapist to access  fee
    $therapist = App\Models\User::with('pricing')->find($reservedSession->therapist_id);

    //validate if reserved session is valid if token matched
    if (Illuminate\Support\Facades\Hash::check($token, $reservedSession->token)) {

        //get the session against which the bill is paid
        \Stripe\Stripe::setApiKey(env('STRIPE_KEY'));
        $stripeSession = \Stripe\Checkout\Session::retrieve($reservedSession->session_id);
        //create a new appointment instance
        $appointment = new \App\Models\Appointment();
        $appointment->therapist_id = $reservedSession->therapist_id;
        $appointment->client_id = $reservedSession->client_id;
        $appointment->amount = $therapist->pricing->therapyFeeUSD();
        $appointment->platform_fee = $therapist->pricing->platformCommissionUSD();
        $appointment->payment_session_id = $reservedSession->session_id;
        $appointment->client_access_token = Illuminate\Support\Str::random(32);
        $appointment->therapist_access_token = Illuminate\Support\Str::random(32);
        $appointment->start_date = $reservedSession->start_date;
        $appointment->end_date = $reservedSession->end_date;
        $appointment->save();
        //reserved session is expired and needs to be deleted
        $reservedSession->delete();
        //appointment status jobs

        dispatchConfirmed($appointment);
        dispatchStarted($appointment);
        dispatchClosed($appointment);
        dispatchReminder($appointment);

        //create chat
        $convExists = \App\Models\Conversation::where('client_id', $appointment->client_id)->where('therapist_id', $appointment->therapist_id)->count() > 0;
        if (not($convExists)) {
            $conversation = new \App\Models\Conversation();
            $conversation->client()->associate($appointment->client);
            $conversation->therapist()->associate($appointment->therapist);
            $conversation->save();
        }
        //return successfully booked view
        return view('booking-status', [
            'status' => 'success',
            'date' => \App\Helpers\UserReadable::sessionDate($appointment->start_date, \Illuminate\Support\Facades\Auth::user()->timezone)
        ]);
    }
    return view('booking-status', ['status' => 'fail']);
})->name('booking-confirmed');


Route::get('booking-failed/{reserved_id}', function ($reserved_id) {

    $reservedSession = \App\Models\ReservedSession::find($reserved_id);
    if (is_null($reservedSession)) {
        abort(404);
    }
    return view('booking-status', ['status' => 'fail']);
})->name('booking-failed');


function dispatchConfirmed($appointment){

    //therapist
    \Illuminate\Support\Facades\Notification::route('mail', $appointment->therapist->email)
    ->notify(new \App\Notifications\AppointmentConfirmedNotification($appointment,$appointment->therapist));

    \Illuminate\Support\Facades\Notification::route('nexmo', $appointment->therapist->phone)
    ->notify(new \App\Notifications\AppointmentConfirmedNotification($appointment,$appointment->therapist));

    //client
    \Illuminate\Support\Facades\Notification::route('mail', $appointment->client->email)
    ->notify(new \App\Notifications\AppointmentConfirmedNotification($appointment,$appointment->client));

    \Illuminate\Support\Facades\Notification::route('nexmo', $appointment->client->phone)
    ->notify(new \App\Notifications\AppointmentConfirmedNotification($appointment,$appointment->client));
}

function dispatchStarted($appointment){

    $date= $appointment->start_date;

    //therapist
    \Illuminate\Support\Facades\Notification::route('mail', $appointment->therapist->email)
    ->notify((new \App\Notifications\AppointmentStartedNotification($appointment,$appointment->therapist))->delay($date));

    \Illuminate\Support\Facades\Notification::route('nexmo', $appointment->therapist->phone)
    ->notify((new \App\Notifications\AppointmentStartedNotification($appointment,$appointment->therapist))->delay($date));

    //client
    \Illuminate\Support\Facades\Notification::route('mail', $appointment->client->email)
    ->notify((new \App\Notifications\AppointmentStartedNotification($appointment,$appointment->client))->delay($date));

    \Illuminate\Support\Facades\Notification::route('nexmo', $appointment->client->phone)
    ->notify((new \App\Notifications\AppointmentStartedNotification($appointment,$appointment->client))->delay($date));
}

function dispatchClosed($appointment){

    //therapist
    \Illuminate\Support\Facades\Notification::route('mail', $appointment->therapist->email)
    ->notify((new \App\Notifications\AppointmentClosedNotification($appointment,$appointment->therapist))->delay($appointment->end_date));

    \Illuminate\Support\Facades\Notification::route('nexmo', $appointment->therapist->phone)
    ->notify((new \App\Notifications\AppointmentClosedNotification($appointment,$appointment->therapist))->delay($appointment->end_date));

    //client
    \Illuminate\Support\Facades\Notification::route('mail', $appointment->client->email)
    ->notify((new \App\Notifications\AppointmentClosedNotification($appointment,$appointment->client))->delay($appointment->end_date));

    \Illuminate\Support\Facades\Notification::route('nexmo', $appointment->client->phone)
    ->notify((new \App\Notifications\AppointmentClosedNotification($appointment,$appointment->client))->delay($appointment->end_date));
}

function dispatchReminder($appointment){

    $date = $appointment->start_date->addHours(-2);

    //therapist
    \Illuminate\Support\Facades\Notification::route('mail', $appointment->therapist->email)
    ->notify((new \App\Notifications\AppointmentReminderNotification($appointment,$appointment->therapist))->delay($date));

    \Illuminate\Support\Facades\Notification::route('nexmo', $appointment->therapist->phone)
    ->notify((new \App\Notifications\AppointmentReminderNotification($appointment,$appointment->therapist))->delay($date));

    //client
    \Illuminate\Support\Facades\Notification::route('mail', $appointment->client->email)
    ->notify((new \App\Notifications\AppointmentReminderNotification($appointment,$appointment->client))->delay($date));

    \Illuminate\Support\Facades\Notification::route('nexmo', $appointment->client->phone)
    ->notify((new \App\Notifications\AppointmentReminderNotification($appointment,$appointment->client))->delay($date));
}

