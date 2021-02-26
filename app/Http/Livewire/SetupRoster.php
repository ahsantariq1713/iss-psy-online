<?php

namespace App\Http\Livewire;

use App\Helpers\AssociateHelper;
use App\Models\Roster;
use App\Models\Session;
use App\Traits\SwalEmitter;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SetupRoster extends Component
{
    use SwalEmitter, AuthorizesRequests;

    public $roster, $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

    protected $rules = [
        'roster.open' => 'required',
        'roster.close' => 'required',
        'roster.duration' => 'required',
        'roster.break' => 'required',
        'roster.monday' => 'boolean',
        'roster.tuesday' => 'boolean',
        'roster.wednesday' => 'boolean',
        'roster.thursday' => 'boolean',
        'roster.friday' => 'boolean',
        'roster.saturday' => 'boolean',
        'roster.sunday' => 'boolean',
    ];

    public function mount()
    {
        $this->roster = Auth::user()->roster;
        if ($this->roster == null) {
            $this->roster = new Roster();
            AssociateHelper::ensureUserAssociated($this->roster, Auth::user());
            $this->roster->save();
            $this->roster->refresh();
        }
    }

    public function update()
    {
        $this->authorize('update', $this->roster);

        $this->validate();

        $this->roster->save();

        Auth::user()->profileLog->update(['roster' => true]);

        $this->generateSessions();

        $this->swalRedirect('success', 'Awesome!', 'Roster  saved successfully', route('therapist.professional-profile', ['sessions']), false, 1500);
    }

    public function render()
    {
        return view('livewire.setup-roster', ['days' => $this->days]);
    }

    private function generateSessions()
    {
        Session::where('user_id', Auth::id())->delete();
        foreach ($this->days as $day) {
            $open = Carbon::parse($this->roster->open, Auth::user()->timezone);
            $close = Carbon::parse($this->roster->close, Auth::user()->timezone);

            while ($open < $close) {
                $data = [];
                $data['id'] = uniqid();
                $data['start'] = Carbon::parse($open->toIso8601String())->setTimezone('utc');
                $data['end'] = Carbon::parse($open->addMinutes($this->roster->duration)->toIso8601String())->setTimezone('utc');
                $data['day'] = $day;
                $data['active'] = $this->roster[$day];
                $session = new Session($data);
                AssociateHelper::ensureUserAssociated($session, Auth::user());
                $session->save();
                $open->addMinutes($this->roster->break);
            }
        }
    }
}
