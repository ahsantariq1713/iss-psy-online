<?php

namespace App\Http\Livewire;

use App\Helpers\ProfileLogStatus;
use App\Helpers\StripeHelper;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BookingCalendar extends Component
{
    public $visitortz, $timezone, $country;
    public $selectedDate, $readableSelected, $selectedSession, $selectedSessionDetails, $calendar, $sessions = [];
    public $therapist = [];

    public function updated($proeprty)
    {
        if ($proeprty == 'timezone' || $proeprty == 'country') {
            $this->visitortz = Auth::check() ?  Auth::user()->timezone : $this->timezone;
        }
    }

    public function mount($id)
    {
        $therapist = \App\Models\User::where('role', 'Therapist')
            ->whereHas('profileLog', function ($query) {
                return $query->where('status', ProfileLogStatus::APPROVED);
            })
            ->where('id', $id)
            ->first();

        if (is_null($therapist)) {
            abort(404);
        }

        $this->calendar = $therapist->getBookingCalendar();

        if (not($this->calendar['available'])) {
            if (is_null($therapist)) {
                abort(404);
            }
        }

        $this->therapist = [
            'id' => $therapist->id,
            'name' => $therapist->name,
            'avatar' => $therapist->avatar,
            'title' => $therapist->license->experience,
            'appointDuration' => $therapist->roster->durationHours(),
            'fee' => $therapist->pricing->therapyFeeUSD()
        ];

        $found = collect($this->calendar['dates'])->filter(function ($date) {
            return $date['available'] == true;
        })->first();

        $this->selectedDate = $found['id'];
        $this->sessions = $found['appointments'];
    }

    public function select($date)
    {
        $this->selectedDate = $date;
        $this->selectedSession = null;
        $this->selectedSessionDetails = null;

        $found = collect($this->calendar['dates'])->filter(function ($date) {
            return $date['id'] == $this->selectedDate;
        })->first();

        $this->sessions = $found['appointments'];
    }

    public function selectSession($session)
    {

        $this->selectedSession = $session;
        $foundDate = collect($this->calendar['dates'])->filter(function ($date) {
            return $date['id'] == $this->selectedDate;
        })->first();

        $foundSession = collect($foundDate['appointments'])->filter(function ($appointment) {
            return $appointment['id'] == $this->selectedSession;
        })->first();

        $this->selectedSessionDetails = $foundSession;
    }

    public function checkout()
    {
        $therapist = User::find($this->therapist['id']);
        $session_id  = StripeHelper::checkout(
            Auth::user(),
            $therapist,
            CarbonImmutable::parse($this->selectedSessionDetails['start']),
            CarbonImmutable::parse($this->selectedSessionDetails['end'])
        );

        //uncomment if the stripe is implemented
        $this->emit('triggerStripeCheckout', [
            'key' =>  env('STRIPE_PUBLIC_KEY'),
            'sessionId' => $session_id
        ]);
    }

    public function render()
    {
        return view('livewire.booking-calendar')->extends('layouts.site');
    }
}
