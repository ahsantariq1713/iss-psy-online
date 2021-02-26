<?php

namespace App\Http\Livewire;

use App\Traits\SwalEmitter;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProProfileSettings extends Component
{
    use SwalEmitter;
    public $page;

    public function mount($page){
        $this->page = $page;
    }

    public function gotoExperience(){
        $this->swalRedirect('success', 'Awesome', 'Education saved successfully' , route('therapist.professional-profile', ['experience']), 1500);
    }

    public function gotoRoster(){
        $this->swalRedirect('success', 'Awesome', 'Experience saved successfully' , route('therapist.professional-profile', ['roster']), 1500);
    }


    public function render()
    {
        return view('livewire.pro-profile-settings',['profileLog' =>  Auth::user()->profileLog])->extends('layouts.dashboard');
    }
}
