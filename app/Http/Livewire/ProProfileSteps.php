<?php

namespace App\Http\Livewire;

use App\Models\ProfileLog;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProProfileSteps extends Component
{
    public  $active;

    protected $listeners = ['refreshProfileLog'];

    public function refreshProfileLog(){}

    public function render()
    {
        return view('livewire.pro-profile-steps', ['profileLog' => Auth::user()->profileLog]);
    }
}
