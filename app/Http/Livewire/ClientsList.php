<?php

namespace App\Http\Livewire;

use App\Helpers\UserRoles;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ClientsList extends Component
{
    public function render()
    {
        $clients = null;
        if (Auth::user()->isAdmin()) {
            $clients = User::where("role", UserRoles::CLIENT)->get();
        } else {
            $clients = User::where("role", UserRoles::CLIENT)->whereHas("clientAppointments", function ($query) {
                $query->where("therapist_id", Auth::id());
            })->get();
        }

        return view('livewire.clients-list', compact('clients'))
            ->extends('layouts.dashboard');
    }
}
