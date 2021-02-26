<?php

namespace App\Http\Livewire;

use App\Events\EchoEvent;
use App\Helpers\ProfileLogStatus;
use App\Models\User;
use App\Notifications\UserActivity;
use App\Traits\SwalEmitter;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TherapistDetails extends Component
{

    use SwalEmitter;

    public $therapist_id;

    protected $listeners = ['showTherapist'];
    public function showTherapist($id){
        $this->therapist_id = $id;
        $this->emit('toggleSidebar');
    }

    public function toggleActive(){
        $therapist =   User::find($this->therapist_id);
        $therapist->active = !$therapist->active;
        $therapist->save();
    }

    public function approve(){
        $this->process(ProfileLogStatus::APPROVED);
        $this->notifyUser(User::find($this->therapist_id), 'Approved');
        $this->swalAlert('success', 'Profile Approved', 'Profile marked as approved',"Ok",1500);
    }

    public function disapprove(){
        $this->process(ProfileLogStatus::DISAPPROVED);
        $this->notifyUser(User::find($this->therapist_id), 'Disapproved');
        $this->swalAlert('success', 'Profile Disapproved', 'Profile marked as disapproved',"Ok",1500);
    }

    public function notifyUser($user, $status){
        $notification = new UserActivity([
            'sender' => Auth::user(),
            'titlePostfix' => 'Your professsional profile is ' . $status . ' by the administrator',
            'url' =>  '/dashboard'
        ]);
        $user->notify($notification);
        broadcast(new EchoEvent('user' . $user->id, 'refresh.nav'))->toOthers();
    }

    public function process($status): void
    {
        $profileLog = User::find($this->therapist_id)->profileLog;
        $profileLog->status = $status;
        $profileLog->verified_at = now();
        $profileLog->save();
        $this->emit('removeCard', $this->therapist_id);
    }

    public function render()
    {
        $therapist = User::with(['identity','profileLog','license','pricing'])->find($this->therapist_id);
        return view('livewire.therapist-details.therapist-details', compact('therapist'));
    }
}
