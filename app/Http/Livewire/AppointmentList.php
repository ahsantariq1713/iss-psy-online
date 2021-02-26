<?php

namespace App\Http\Livewire;

use App\Helpers\UserRoles;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AppointmentList extends Component
{
    public function render()
    {
        $appointments = null;
        if(not(Auth::user()->isAdmin())){
            $userKey = strtolower(Auth::user()->role) . '_id';
            $appointments = Appointment::where($userKey, Auth::id())->orderBy('start_date', 'desc')->get();
        }else{
            $appointments = Appointment::all();
        }
        return view('livewire.appointment-list', compact('appointments'))->extends('layouts.dashboard');
    }
}
