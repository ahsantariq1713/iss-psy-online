<?php

namespace App\Http\Livewire;

use App\Helpers\Redirectable;
use App\Traits\SwalEmitter;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class SetupProfilePicture extends Component
{

    use WithFileUploads, SwalEmitter;
    public $avatar;
    public $back, $next, $skip;

    public $rules = [
        'avatar' => 'image|max:2048',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        if ($propertyName == 'avatar') {
            $this->upload();
        }
    }

    public function mount()
    {
        Redirectable::getQueryString(request(), $this);
    }

    public function upload()
    {
        $this->validate();
        $user = Auth::user();
        $fileName = 'assets/images/users/' . 'user_' . $user->id . '.png';
        $user->avatar = $this->avatar->store($fileName);
        $user->save();

        $this->swalRedirect(
            'success',
            'Awesome!',
            'Your profile picture is changed successfully.',
            Redirectable::nextUrl($this, '/account-settings'),
            false,
            1500
        );
    }

    public function render()
    {
        return view('livewire.setup-profile-picture')->extends('layouts.dashboard');
    }
}
