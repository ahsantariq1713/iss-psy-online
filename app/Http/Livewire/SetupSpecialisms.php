<?php

namespace App\Http\Livewire;

use App\Models\Specialism;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SetupSpecialisms extends Component
{
    public $specialisms = [], $mySpecialisms = [], $specialism = null;

    public function mount()
    {
        $this->refreshProperties();
        $this->specialisms = Specialism::whereNotIn('id', collect($this->mySpecialisms)->pluck('id'))->get();
    }

    public function updated($propertyName)
    {
        if ($propertyName == 'specialism' && $this->specialism != null) {
            Auth::user()->specialisms()->attach($this->specialism);
            $this->emit('remove-specialism', $this->specialism);
            $this->refreshProperties();
        }
    }

    public function delete($payload){
        Auth::user()->specialisms()->detach($payload['id']);
        $this->emit('add-specialism', $payload);
        $this->refreshProperties();
    }

    public function render()
    {
        return view('livewire.setup-specialisms');
    }

    private function refreshProperties(): void
    {
        $this->mySpecialisms = Auth::user()->specialisms;
        $this->specialism = null;
    }
}
