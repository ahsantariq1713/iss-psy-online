<?php

namespace App\Http\Livewire;

use App\Helpers\Redirectable;
use App\Models\User;
use App\Models\VerificationCode;
use App\Traits\SwalEmitter;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Str;

class VerifyPasswordResetCode extends Component
{
    use SwalEmitter;

    public $secret, $codeid, $type, $message;

    public $rules = [
        'secret' => 'required|integer'
    ];

    public function mount($id)
    {
        $verificationCode = VerificationCode::find($id);
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

            $user = User::where('email', $code->medium)->first();

            $token =  Str::random(64);

            //set email verified
            $user->password_reset_token = Hash::make($token);
            $user->prt_valid_till = now()->addMinutes(60);
            $user->save();

            //delete verification code
            $code->delete();

            $redirect = '/reset-password?email=' . $user->email . '&token=' . $token;
            $this->swalRedirect('success', 'Verification Complete!', 'Reset your password', $redirect, false);
            return null;
        }

        //verification failed
        $this->swalAlert('warning', 'Verification Failed!', 'You entered incorrect verification code');
    }

    public function resend()
    {
        VerificationCode::find($this->codeid)->resend();
        $this->swalAlert('success', 'Password Reset Code Sent!', 'we send new password reset code to your email');
    }
    public function render()
    {
        return view('livewire.verify-password-reset-code')->extends('layouts.auth');
    }
}
