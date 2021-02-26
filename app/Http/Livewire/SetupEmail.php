<?php

namespace App\Http\Livewire;

use App\Helpers\Redirectable;
use App\Helpers\VerificationCodes;
use App\Models\VerificationCode;
use App\Traits\SwalEmitter;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SetupEmail extends Component
{
    use SwalEmitter;

    public $email , $password;
    public $back,$next,$skip;

    public $rules = [
        'email' => 'required|email|unique:users,email',
        'password' => 'required'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        Redirectable::getQueryString(request(),$this);
    }

    public function change()
    {
        $this->validate();

        $user =  Auth::user();

        if($user->failPasswordChallenge($this->password)){
            $this->swalAlert('error', 'Incorrect Password', 'Enter your last password');
            return null;
        }

       $user->update([
            'new_email' => $this->email
        ]);

        $verification = VerificationCode::send('mail', $this->email,VerificationCodes::CHANGE_EMAIL_VERIFICATION);

        $url = '/verify-email/' . $verification->id . '?next=' . Redirectable::nextUrl($this,'/dashboard');
        $this->swalRedirect('success', 'New Email Added!', 'We sent you an email verification code to new email address', $url, false );
    }

    public function render()
    {
        return view('livewire.setup-email')->extends('layouts.dashboard');
    }
}
