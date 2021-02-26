<?php

namespace App\Http\Livewire;

use App\Helpers\Redirectable;
use App\Helpers\VerificationCodes;
use App\Models\Country;
use App\Models\VerificationCode;
use App\Traits\SwalEmitter;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SetupPhone extends Component
{
    use SwalEmitter;

    public $countries, $code, $phone, $password, $country, $timezone;
    public $back, $next, $skip;

    public $rules = [
        'phone' => 'required|unique:users,phone|integer',
        'password' => 'nullable'
    ];

    protected $messages = [
        'phone.integer' => 'Enter a valid phone number without leading zero and without country code'
    ];

    protected $listeners = ['countryFetched'];

    public function countryFetched()
    {
        $selected = $this->countries->where('name', strtoupper($this->country))->first();
        $this->code = $selected->code;
        $this->emit('selectCountry', $selected->code);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->countries = Country::all();
        Redirectable::getQueryString(request(), $this);
    }

    public function submit()
    {
        if (is_null($this->code)) {
            $this->swalAlert('warning', 'Missing Country Code', 'Please select your country code');
            return null;
        }

        $this->validate();

        $phoneNumber = $this->code . $this->phone;

        $user = Auth::user();

        $type = VerificationCodes::PHONE_VERIFICATION;

        if (not_null($user->phone)) {

            $this->validate(['password' => 'required']);

            if ($user->failPasswordChallenge($this->password)) {
                $this->swalAlert('error', 'Incorrect Password', 'Enter your last password');
                return null;
            }
            $user->update([
                'new_phone' => $phoneNumber
            ]);

            $type = VerificationCodes::CHANGE_PHONE_VERIFICATION;
        } else {

            $user->update([
                'phone' => $phoneNumber
            ]);
        }

        $verification = VerificationCode::send('nexmo', $phoneNumber, $type);
        $url = '/verify-phone/' . $verification->id . '?next=' . Redirectable::nextUrl($this, '/dashboard');
        $this->swalRedirect('success', 'Phone Number Added!', 'We sent you a phone number verification code.', $url, false);
    }

    public function render()
    {
        return view('livewire.setup-phone')->extends('layouts.dashboard');
    }
}
