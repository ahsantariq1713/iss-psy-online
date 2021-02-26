<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TermsOfService extends Component
{
    public function render()
    {
        return view('livewire.terms-of-service')->extends('layouts.site');
    }
}
