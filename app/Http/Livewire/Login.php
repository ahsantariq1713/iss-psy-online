<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Traits\SwalEmitter;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    use SwalEmitter, ThrottlesLogins;

    public $email, $password, $timezone, $country, $remember = 0;
    public $next;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
        'timezone' => 'nullable',
        'country' => 'nullable'
    ];

    public function mount(){
        $this->next = request()->next;
    }

    public function login()
    {
        $this->validate();

        //request attributes
        $request = request();
        $request->attributes->set('email', $this->email);

        //too many attempts
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $this->sendLockoutError();
            return null;
        }

        //find user, validate password challenge, check user is active
        $user = User::where('email', $this->email)->first();

        if (is_null($user) || $user->failPasswordChallenge($this->password)) {
            $this->incrementLoginAttempts($request);
            $this->sendFailedError();
            return null;
        }

        if (not($user->active)) {
            $this->incrementLoginAttempts($request);
            $this->sendBlockedError();
            return null;
        }

        //login user
        Auth::login($user, $this->remember);

        //set user attributes
        $user->update([
            'timezone' => $this->timezone,
            'country' => $this->country,
        ]);

        $this->clearLoginAttempts($request);

        $redirect = $this->next ?? '/dashboard';

        $this->swalRedirect('success', 'Login Successful!', 'You will be redirected to dashboard.', $redirect , false, 1500);
    }

    public function render()
    {
        $redirect = '/register';
        $redirect = not_null($this->next) ? $redirect . '?next='  . $this->next : $redirect;
        return view('livewire.login')->extends('layouts.auth', [
            'redirect' => '<p> Don\'t have an account? <a href="' . $redirect . '">Create One</a></p>'
        ]);
    }

    private function sendFailedError()
    {
        $this->swalAlert('error', 'Login Failed!', 'Invalid email or password');
    }

    private function sendBlockedError()
    {
        $this->swalAlert('error', 'Account Blocked!', 'Your account is blocked.');
    }

    private function sendLockoutError()
    {
        $this->swalAlert('error', 'Login Failed!', 'You attempted too many times. Please try again later.');
    }

    public function username()
    {
        return 'email';
    }
}
