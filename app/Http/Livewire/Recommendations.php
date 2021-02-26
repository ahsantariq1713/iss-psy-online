<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Recommendations extends Component
{
    public function render()
    {
        return view('livewire.recommendations.recommendations', ['user'=>Auth::user()])->extends('layouts.dashboard');
    }
}
