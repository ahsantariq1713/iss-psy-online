<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Stripe\Stripe;

class SetupPayment extends Component
{
    public function connect()
    {
        $user = Auth::user();

        $stripeKey = env('STRIPE_KEY');
        Stripe::setApiKey($stripeKey);

        if ($user->stripe_acc_id == null) {
            $account = \Stripe\Account::create([
                'type' => 'express',
                'email' => $user->email,
                'capabilities' => [
                    'card_payments' => [
                        'requested' => true,
                    ],
                    'transfers' => [
                        'requested' => true,
                    ],
                ],
            ]);
            $user->stripe_acc_id = $account->id;
            $user->save();
        }

        $account_links = \Stripe\AccountLink::create([
            'account' => $user->stripe_acc_id,
            'refresh_url' => route('stripe-refresh'),
            'return_url' => route('stripe-return'),
            'type' => 'account_onboarding',
        ]);
        return redirect($account_links->url);
    }

    public function render()
    {
        return view('livewire.setup-payment', ['profileLog' => Auth::user()->profileLog]);
    }
}
