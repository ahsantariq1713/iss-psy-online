<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use Livewire\Component;

class MySpending extends Component
{
    public function render()
    {
        $appointments = Appointment::where('status', 'Completed')->where('client_id', \Auth::id())->get();
        return view('livewire.my-spending', compact('appointments'))
            ->extends('layouts.dashboard');
    }
}
