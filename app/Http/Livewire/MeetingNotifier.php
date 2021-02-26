<?php

namespace App\Http\Livewire;

use App\Events\EchoEvent;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MeetingNotifier extends Component
{
    public $userId, $attendMeetingUrl = '',$caller = ['name' => 'Test', 'avatar' => 'assets/images/users/default.png', 'appointmentId' => 1];

    protected $listeners = ['callReceived', 'rejectCall'];

    public function callReceived($caller){
        $this->caller = $caller;
        $appointment = Appointment::find($caller['appointmentId']);
        $token = Auth::user()->isTherapist() ? $appointment->therapist_access_token : $appointment->client_access_token;
        $this->attendMeetingUrl = route('attend-meeting', ['id' => $appointment->id, 'token' => $token]);

    }

    public function rejectCall(){
        $activity = new EchoEvent('user' . $this->caller['id'] , 'call.rejected');
        broadcast($activity)->toOthers();
        $this->attendMeetingUrl = '';
    }

    public function mount(){
        $this->userId = Auth::id();
    }

    public function render()
    {
        return view('livewire.meeting-notifier');
    }
}
