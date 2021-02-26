<?php

namespace App\Http\Livewire;

use App\Events\EchoEvent;
use App\Models\Appointment;
use App\Notifications\UserActivity;
use App\Traits\SwalEmitter;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AppointmentRecommendationsSave extends Component
{
    use SwalEmitter;
    public $appointmentId,$recs;

    public function mount($id){
        $this->appointmentId = $id;
    }

    public function updated($property)
    {
        switch ($property) {
            case 'recs':
                $this->saveRecs();
                break;
        }
    }

    public function saveRecs(){

        $appointment = Appointment::find($this->appointmentId);
        $allowed = Auth::id() == $appointment->therapist->id && $appointment->allowUpdateRecommendations();
        if($allowed){
            $appointment->recommendations = $this->recs;
            $appointment->save();
            $this->swalAlert('success', 'Awesome', 'Recommendations have been saved', "Ok", 1500);
        }
    }

    public function markComplete(){
        $appointment = Appointment::with('client')->find($this->appointmentId);
        if(Auth::id() == $appointment->therapist->id){
            $appointment->save();
            $notification = new UserActivity([
                'sender' => Auth::user(),
                'titlePostfix' => Auth::user()->name . ' submitted recommendations  against your appointment # ' . $appointment->id,
                'url' =>  '/appointment-show/' . $appointment->id
            ]);
            $appointment->client->notify($notification);
            broadcast(new EchoEvent('user' . $appointment->client_id, 'refresh.nav'))->toOthers();
            $this->swalAlert('success', 'Submitted', 'Your client is notified.', "Ok", 1500);
        }

    }


    public function render()
    {
        $appointment = Appointment::findOrFail($this->appointmentId);
        return view('livewire.appointment-recommendations-save', compact('appointment'));
    }
}
