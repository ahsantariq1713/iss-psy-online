<?php

namespace App\Http\Livewire;

use App\Helpers\Redirectable;
use App\Traits\SwalEmitter;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SetupBasicInfo extends Component
{
    use SwalEmitter;
    public $userModel;
    public $back,$next,$skip;

    public $rules = [
        'userModel.name' => 'required',
        'userModel.birthday' => 'required',
        'userModel.gender' => 'required',
    ];

    public function mount(){
        $this->userModel = Auth::user()->only(['name','gender','birthday']);
        Redirectable::getQueryString(request(),$this);

    }

    public function update(){
        $this->validate();
        Auth::user()->update($this->userModel);
        $this->swalRedirect('success', 'Awesome!', 'Your basic info has been saved', Redirectable::nextUrl($this,'/account-settings'), false, 1500);

    }

    public function render()
    {
        return view('livewire.setup-basic-info')->extends('layouts.dashboard');
    }
}
