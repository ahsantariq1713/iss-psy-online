<?php

namespace App\Http\Livewire;

use App\Helpers\UserRoles;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyTherapistsList extends Component
{
    public function render()
    {
        $therapists = User::where('role', UserRoles::THERAPIST)->whereHas('therapistAppointments', function ($q) {
            $q->where('client_id', Auth::id());
        })->distinct()->with('therapistAppointments')->get();
        return view('livewire.my-therapists-list', compact('therapists'))
            ->extends('layouts.dashboard');
    }
}
