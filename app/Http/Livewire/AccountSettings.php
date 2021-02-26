<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AccountSettings extends Component
{
    public function render()
    {
        return view('livewire.account-settings.account-settings')->extends('layouts.dashboard');
    }
}
