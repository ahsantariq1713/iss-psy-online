<?php

namespace App\Http\Livewire;

use App\Helpers\Redirectable;
use App\Models\User;
use App\Models\VerificationCode;
use App\Traits\SwalEmitter;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VerifyPhone extends Component
{
    use SwalEmitter;

    public $secret, $codeid, $type, $message;
    public $back, $next, $skip;

    public $rules = [
        'secret' => 'required|integer'
    ];

    public function mount(VerificationCode $verificationCode)
    {
        Redirectable::getQueryString(request(), $this);
        $this->codeid = $verificationCode->id;
        $this->type = $verificationCode->type;
        $this->message = $verificationCode->sentMessage();
    }

    public function verify()
    {
        $this->validate();

        //get verification code
        $code = VerificationCode::find($this->codeid);

        //verification code expired
        if ($code->isExpired()) {
            $this->swalAlert('error', 'Session Expired!', 'Verification session is expired');
            return null;
        }

        //secret code is correct
        if ($code->passSecretChallenge($this->secret)) {

            //$user = User::where('phone', $code->medium)->first();
            $user = Auth::user();
            //replace phone with new phone
            if (not_null($user->new_phone)) {
                $user->phone = $user->new_phone;
            }

            //set phone verified
            $user->update([
                'phone_verified_at' => now(),
                'new_phone' => null
            ]);

            //delete verification code
            $code->delete();

            $this->swalRedirect('success', 'Phone  Verified!', 'You phone verification is complete', Redirectable::nextUrl($this, '/dashboard'), false);
            return null;
        }

        $this->swalAlert('warning', 'Verification Failed!', 'You entered incorrect verification code');
    }

    public function resend()
    {
        VerificationCode::find($this->codeid)->resend();
        $this->swalAlert('success', 'Verification Code Sent!', 'we send new verification code to your phone');
    }

    public function render()
    {
        return view('livewire.verify-phone')->extends('layouts.auth');
    }
}
