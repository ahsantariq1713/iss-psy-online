<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Traits\SwalEmitter;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ResetPassword extends Component
{
    use SwalEmitter;

    public $email, $token, $password, $password_confirmation;

    public function mount()
    {
        $this->email = request()->email;
        $this->token = request()->token;

        if (is_null($this->email) || is_null($this->token) || strlen($this->token) <= 0) {
            abort(401);
        }
    }


    protected $rules = [
        'password' => 'required|confirmed',
    ];

    public function resetPassword()
    {
        $this->validate();
        $user = User::where('email', $this->email)->where('password_reset_token' , '!=' , null)->first();

        if(is_null($user)){
            $this->swalAlert('error', 'Invalid Request', 'Your request is invalid and cannot be processed.');
            return;
        }

        if (Hash::check($this->token, $user->password_reset_token) && now()->diffInMinutes($user->prt_valid_till) < 60) {
            $user->setPasswordHash($this->password);
            $user->password_reset_token = null;
            $user->prt_valid_till = null;
            $user->password_changed_at = now();
            $user->save();
            $this->swalRedirect('success', 'Password Updated', 'Your new password has been updated.', '/login', 1500);
        } else {
            $this->swalAlert('error', 'Session Expired', 'Your password reset session is expired.');
        }
    }

    public function render()
    {
        return view('livewire.reset-password')->extends('layouts.auth');
    }
}
