<?php

namespace App\Http\Livewire;

use App\Helpers\Redirectable;
use App\Models\User;
use App\Models\VerificationCode;
use App\Traits\SwalEmitter;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VerifyEmail extends Component
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

        //find verification code
        $code = VerificationCode::find($this->codeid);

        //verification code expired
        if ($code->isExpired()) {
            $this->swalAlert('error', 'Session Expired!', 'Verification session is expired');
            return null;
        }

        //secret is correct
        if ($code->passSecretChallenge($this->secret)) {

            //$user = User::where('email', $code->medium)->first();
            $user = Auth::user();

            //replace email with new email
            if (not_null($user->new_email)) {
                $user->email = $user->new_email;
            }

            //set email verified
            $user->update([
                'email_verified_at' => now(),
                'new_email' => null
            ]);

            //delete verification code
            $code->delete();

            $this->swalRedirect('success', 'Email Verified!', 'You email verification is complete', Redirectable::nextUrl($this, '/dashboard'), false);
            return null;
        }

        //verification failed
        $this->swalAlert('warning', 'Verification Failed!', 'You entered incorrect verification code');
    }

    public function resend()
    {
        VerificationCode::find($this->codeid)->resend();
        $this->swalAlert('success', 'Verification Code Sent!', 'we send new verification code to your email');
    }

    public function render()
    {
        return view('livewire.verify-email')->extends('layouts.auth');
    }
}
