<?php

namespace App\Http\Livewire;

use App\Events\EchoEvent;
use App\Helpers\ProfileLogStatus;
use App\Models\ProfileLog;
use App\Models\User;
use App\Notifications\UserActivity;
use App\Traits\SwalEmitter;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminTherapistView extends Component
{
    use SwalEmitter;

    public $therapistId;

    public function mount($therapistId){
        User::findorFail($therapistId);
        $this->therapistId = $therapistId;
    }


    public function toggleActive(){
        $therapist =   User::find($this->therapistId);
        $therapist->active = !$therapist->active;
        $therapist->save();
    }


    public function approve(){
        $this->process(ProfileLogStatus::APPROVED);
        $this->notifyUser(User::find($this->therapistId), 'Approved');
        $this->swalAlert('success', 'Profile Approved', 'Profile marked as approved',"Ok",1500);
    }

    public function disapprove(){
        $this->process(ProfileLogStatus::DISAPPROVED);
        $this->notifyUser(User::find($this->therapistId), 'Disapproved');
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
        $profileLog = User::find($this->therapistId)->profileLog;
        $profileLog->status = $status;
        $profileLog->verified_at = now();
        $profileLog->save();
        // $this->emit('removeCard', $this->therapist_id);
    }

    public function render()
    {
        $therapist = User::with([
            'profileLog','identity','license','roster','sessions','pricing','educations','experiences', 'therapistAppointments'
        ])->find($this->therapistId);

        $appCount = [
            'pending' => 0,
            'active' => 0,
            'completed' => 0,
            'canceled' => 0
        ];

      if($therapist->appointments!= null && $therapist->appointments->count() > 0){
        $appCount['pending'] = $therapist->appointments->where('status', 'Pending')->count();
        $appCount['active'] = $therapist->appointments->where('status', 'Active')->count();
        $appCount['completed'] = $therapist->appointments->where('status', 'Completed')->count();
        $appCount['canceled'] = $therapist->appointments->where('status', 'Canceled')->count();
      }
        return view('livewire.admin-therapist-view', compact('therapist', 'appCount'));
    }
}
