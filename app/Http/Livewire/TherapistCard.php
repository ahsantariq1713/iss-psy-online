<?php

namespace App\Http\Livewire;

use App\Helpers\ProfileLogStatus;
use App\Models\User;
use App\Traits\SwalEmitter;
use Livewire\Component;

class TherapistCard extends Component
{
    use SwalEmitter;

    public $therapist;

    public function show(){
        $this->emit('showTherapist', $this->therapist['id']);
    }

    public function render()
    {
        return view('livewire.therapist-card');
    }
}
