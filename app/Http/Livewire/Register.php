<?php

namespace App\Http\Livewire;

use App\Helpers\UserRoles;
use App\Helpers\VerificationCodes;
use App\Models\ProfileLog;
use App\Models\User;
use App\Models\VerificationCode;
use App\Traits\SwalEmitter;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Register extends Component
{
    use SwalEmitter;

    public $user, $password, $type, $timezone, $country;
    public $next;

    protected $rules = [
        'user.name' => 'required',
        'user.email' => 'required|email|unique:users,email',
        'user.birthday' => 'required',
        'user.gender' => 'required',
        'password' => 'required|min:8',
        'user.subscribed_newsletter' => 'nullable',
        'type' => 'required',
        'timezone' => 'nullable',
        'country' => 'nullable'
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function mount()
    {
        $this->user = new User();
        $this->next = request()->next;
    }

    public function register()
    {
        $this->validate();

        //set user attributes
        $this->user->timezone = $this->timezone;
        $this->user->country = $this->country;
        $this->user->setPasswordHash($this->password);
        $this->user->role = $this->type == 'dGhlcmFwaXN0' ? UserRoles::THERAPIST : UserRoles::CLIENT;
        $this->user->subscribed_newsletter = is_null($this->user->subscribed_newsletter) ? false : true;
        $this->user->save();

        //create profile log if ther is theraoust
        if ($this->user->role == UserRoles::THERAPIST) {
            $profileLog = new ProfileLog();
            $profileLog->user()->associate($this->user);
            $profileLog->save();
        }

        //login user
        Auth::login($this->user, false);

        //send email verification
        $verification = VerificationCode::send('mail', $this->user->email, VerificationCodes::EMAIL_VERIFICATION);
        $redirect = '/verify-email/' . $verification->id;
        $redirect = $redirect . (not_null($this->next) ? '?next=' . $this->next : '?next=/setup-phone?skip=/dashboard');
        $this->swalRedirect('success', 'Account Created!', 'Please verify your email address', $redirect, false);
    }

    public function render()
    {
        return view('livewire.register')
            ->extends('layouts.auth', ['redirect' => '<p> Already have an account? <a href="/login">Login</a></p>']);
    }
}
