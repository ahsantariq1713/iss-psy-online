<?php

namespace App\Http\Livewire;

use App\Helpers\VerificationCodes;
use App\Models\User;
use App\Models\VerificationCode;
use App\Traits\SwalEmitter;
use Livewire\Component;

class ForgotPassword extends Component
{
    use SwalEmitter;
    public $email;

    protected $rules = [
        'email' => 'required'
    ];

    public function send()
    {
        $this->validate();
        if ((User::where('email', '=', $this->email)->first()) != null) {
            $verification = VerificationCode::send('mail', $this->email, VerificationCodes::PASSWORD_RESET);
            $redirect = '/verify-password-reset-code/' . $verification->id;
            $redirect = $redirect;
            $this->swalRedirect('success', 'Reset Code Sent', 'Please verify password reset code', $redirect, false);
        }
        else{
            $this->swalAlert('error', 'Invalid Email', 'There is no account associated with your email address');
        }
    }


    public function render()
    {
        return view('livewire.forgot-password')->extends('layouts.auth');
    }
}
