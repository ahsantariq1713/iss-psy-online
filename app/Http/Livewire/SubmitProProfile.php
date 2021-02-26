<?php

namespace App\Http\Livewire;

use App\Events\EchoEvent;
use App\Helpers\ProfileLogStatus;
use App\Helpers\UserRoles;
use App\Models\User;
use App\Notifications\ProProfileVerificationRequested;
use App\Notifications\UserActivity;
use App\Traits\SwalEmitter;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SubmitProProfile extends Component
{
    use SwalEmitter;

    public function submit()
    {
        $user = Auth::user();
        $profileLog = Auth::user()->profileLog;
        $profileLog->status = ProfileLogStatus::UNDER_REVIEW;
        $user->profileLog->save();

        $notification = new UserActivity([
            'sender' => Auth::user(),
            'titlePostfix' => 'requested for professional profile verification',
            'url' =>  '/approval-requests?search=' . Auth::user()->email
        ]);

        $admin =  User::where('role', UserRoles::ADMIN)->first();
        $admin->notify($notification);
        broadcast(new EchoEvent('user' . $admin->id, 'refresh.nav'))->toOthers();

        $this->emit('proProfileSubmitted');
        $this->swalRedirect('success', 'Profile Submitted!', 'Your profile request has been submitted', '/dashboard', false, 0);
    }

    public function render()
    {
        return view('livewire.submit-pro-profile', ['user' => Auth::user()]);
    }
}
