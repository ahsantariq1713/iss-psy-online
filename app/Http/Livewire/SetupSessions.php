<?php

namespace App\Http\Livewire;

use App\Traits\SwalEmitter;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SetupSessions extends Component
{
    use SwalEmitter, AuthorizesRequests;

    public $activeDays, $sessions = [], $day;

    protected $rules = ['day' => 'required'];

    public function mount()
    {
        $this->getActiveDays();
        $this->getSessions();
    }

    public function updated($propertyName)
    {
        if ($propertyName == 'day') {
            $this->getSessions();
        }
    }

    public function update()
    {
        Auth::user()->profileLog->update(['sessions' => true]);
        $this->swalRedirect('success', 'Awesome!', 'Appointment sessions setup successfully', route('therapist.professional-profile', ['pricing']), false, 1500);
    }

    public function render()
    {
        return view('livewire.setup-sessions');
    }

    public function toggle($id)
    {
        $session = $this->sessions->where('id', $id)->first();
        $this->authorize('toggle', $session);
        $session->update(['active' => !$session->active]);
    }

    private function getActiveDays(): void
    {
        $roster = Auth::user()->roster;
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        foreach ($days as $day) {
            if ($roster[$day] == true) {
                $this->activeDays[] = $day;
            }
        }
        $this->day = $this->activeDays[0];
    }

    private function getSessions(): void
    {
        $this->sessions = Auth::user()->sessions->where('day', strtolower($this->day));
    }
}
