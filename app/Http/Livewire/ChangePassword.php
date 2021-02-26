<?php

namespace App\Http\Livewire;

use App\Traits\SwalEmitter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    use SwalEmitter;

    public $password,$new_password,$password_confirmation;

    public $rules = [
        'password' => 'required',
        'new_password' => 'required|min:8|same:password_confirmation'
    ];

    public function change(){
        $this->validate();
        $user = Auth::user();
        if(Hash::check($this->password, $user->password)){
            $user->setPasswordHash($this->new_password);
            $user->password_changed_at = now();
            $user->save();
            $this->swalRedirect('success', 'Password Changed','Your password has been changed','/account-settings', false,1500);
            return null;
        }

        $this->swalAlert('warning', 'Incorrect Password','You entered an invalid current password');
    }

    public function render()
    {
        return view('livewire.change-password')->extends('layouts.dashboard');
    }
}
