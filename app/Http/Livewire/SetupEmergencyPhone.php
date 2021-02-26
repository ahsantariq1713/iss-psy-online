<?php

namespace App\Http\Livewire;

use App\Helpers\AssociateHelper;
use App\Models\Country;
use App\Models\EmergencyPhone;
use App\Traits\SwalEmitter;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SetupEmergencyPhone extends Component
{
    use SwalEmitter;

    public $countries, $ephone;

    protected $rules = [
        'ephone.code' => 'required|string',
        'ephone.phone' => 'required|integer',
        'ephone.relation' => 'required'
    ];

    public function mount()
    {
        $this->countries = Country::all();
        $this->ephone =  Auth::user()->emergencyPhone ?? new EmergencyPhone();
    }

    public function change()
    {
        $this->validate();
        AssociateHelper::ensureUserAssociated($this->ephone,Auth::user());
        $this->ephone->save();
        $this->swalRedirect('success', 'Awesome!', 'Your emergency phone has been saved', '/account-settings', false, 1500);
    }

    public function render()
    {
        return view('livewire.setup-emergency-phone')->extends('layouts.dashboard');
    }
}
