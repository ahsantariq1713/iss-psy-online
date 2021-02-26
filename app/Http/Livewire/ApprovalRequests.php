<?php

namespace App\Http\Livewire;

use App\Helpers\ProfileLogStatus;
use App\Helpers\UserRoles;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ApprovalRequests extends Component
{
    public $therapists, $search;

    protected $listeners = ['removeCard'];
    public function removeCard($id)
    {
        $this->therapists = collect($this->therapists)->filter(function ($therapist, $id) {
            return $therapist['id'] == $id;
        });
    }

    public function updated($property)
    {
        if ($property == 'search') {
            $this->loadTherapists();
        }
    }

    public function mount()
    {
        $this->search = request()->search;
        $this->loadTherapists();
    }

    public function render()
    {
        return view('livewire.approval-requests')
            ->extends('layouts.dashboard');
    }

    private function loadTherapists()
    {
        $this->therapists =
            User::where('role', UserRoles::THERAPIST)
            ->whereHas('profileLog', function ($profileLog) {
                return $profileLog->where('status', ProfileLogStatus::UNDER_REVIEW);
            })
            ->where(function ($user) {
                return
                    $user->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('country', 'like', '%' . $this->search . '%');
            })
            ->with(['roster', 'license', 'pricing'])->get()
            ->map(function ($therapist) {
                return [
                    'id' => $therapist->id,
                    'name' => $therapist->name,
                    'email' => $therapist->email,
                    'avatar' => $therapist->avatar,
                    'country' => $therapist->country,
                    'hourlyRate' => $therapist->pricing->fee,
                    'title' => $therapist->license->academic_title,
                    'experienced_in' => $therapist->license->experience,
                    'experience_years' => $therapist->experienceYears(),
                    'profileStatus' => $therapist->profileLog->status,
                    'roster' => [
                        'open' => $therapist->roster->openReadable(Auth::user()->timezone),
                        'close' => $therapist->roster->closeReadable(Auth::user()->timezone),
                        'duration' => $therapist->roster->durationHours()
                    ]
                ];
            });
    }
}
