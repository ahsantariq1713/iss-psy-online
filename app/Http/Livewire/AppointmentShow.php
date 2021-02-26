<?php

namespace App\Http\Livewire;

use App\Events\EchoEvent;
use App\Models\Appointment;
use App\Notifications\UserActivity;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AppointmentShow extends Component
{
    public $appointmentId,$stars,$feedback;

    public function mount($id){
        $this->appointmentId = $id;
    }

    public function postFeeback(){
        if(not(Auth::user()->isClient())) return null;

        $appointment = Appointment::with('therapist')->findOrFail($this->appointmentId);

        if($appointment->requiresFeedback()){
            $appointment->stars = $this->stars;
            $appointment->feedback = $this->feedback;
            $appointment->save();
            $notification = new UserActivity([
                'sender' => Auth::user(),
                'titlePostfix' => Auth::user()->name . ' gave a ' . $this->stars . ' star review against your appointment # ' . $appointment->id,
                'url' =>  '/appointment-show/' . $appointment->id
            ]);
            $appointment->therapist->notify($notification);
            broadcast(new EchoEvent('user' . $appointment->therapist_id, 'refresh.nav'))->toOthers();
        }
    }

    public function render()
    {
        $appointment = Appointment::findOrFail($this->appointmentId);
        if ($appointment->client_id != Auth::id() && $appointment->therapist_id != Auth::id() && not(Auth::user()->isAdmin())) {
            abort(401);
        }
        return view('livewire.appointment-show', compact('appointment'))->extends('layouts.dashboard');
    }
}
