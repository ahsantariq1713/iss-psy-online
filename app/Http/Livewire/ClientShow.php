<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class ClientShow extends Component
{
    public $clientId;

    public function mount($id)
    {
        $this->clientId = $id;
    }

    public function render()
    {
        $client = User::findOrFail($this->clientId);
        return view('livewire.client-show', compact('client'))
            ->extends('layouts.dashboard');
    }
}
