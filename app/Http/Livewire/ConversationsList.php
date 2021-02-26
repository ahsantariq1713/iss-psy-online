<?php

namespace App\Http\Livewire;

use App\Helpers\UserRoles;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ConversationsList extends Component
{
    public $conversations, $search;

    public function mount(){
        $user = Auth::user();
        $this->conversations = $user->role == UserRoles::THERAPIST ? $user->conversationsAsTherapist : $user->conversationsAsClient;
    }

    public function updated($property){
        if($property == 'search'){
            $this->search();
        }
    }

    public function search(){
        $this->conversations =
            Auth::user()->role == UserRoles::THERAPIST
                    ?   Conversation::where('therapist_id', Auth::id())->whereHas('client',function($client){
                        $client->where('name', 'like' , '%' . $this->search .  '%');
                    })->get()
                    :   Conversation::where('client_id', Auth::id())->whereHas('therapist',function($therapist){
                        $therapist->where('name', 'like' , '%' . $this->search .  '%');
                    })->get();
    }

    public function render()
    {
        return view('livewire.conversations-list')->extends('layouts.dashboard');
    }
}
