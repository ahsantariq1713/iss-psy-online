<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserDashboard extends Component
{
    protected $listeners = ['proProfileSubmitted'];

    public function proProfileSubmitted()
    {

    }

    public function render()
    {
        return view('livewire.user-dashboard.user-dashboard', ['user' => Auth::user()])
            ->extends('layouts.dashboard');
    }
}
