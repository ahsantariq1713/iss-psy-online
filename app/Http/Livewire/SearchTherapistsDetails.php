<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class SearchTherapistsDetails extends Component
{
    public $visitortz, $timezone, $country;
    public $therapistId, $specialisms = [];


    public function mount($id)
    {
        $this->therapistId = $id;
    }

    public function render()
    {
        $therapist = User::with('license', 'specialisms', 'roster', 'pricing')->find($this->therapistId);
        if (is_null($therapist)) abort(404);
        return view('livewire.search-therapists-details', compact('therapist'))

            ->extends('layouts.site');
    }
}
