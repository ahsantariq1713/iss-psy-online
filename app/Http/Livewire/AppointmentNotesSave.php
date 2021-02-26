<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AppointmentNotesSave extends Component
{
    public $appointmentId,$notes;

    public function mount($id){
        $this->appointmentId = $id;
    }

    public function updated($property)
    {
        switch ($property) {
            case 'notes':
                $this->saveNotes();
                break;
        }
    }

    public function saveNotes(){

        $appointment = Appointment::find($this->appointmentId);
        $allowed = Auth::id() == $appointment->therapist->id;
        if($allowed){
            $appointment->notes = $this->notes;
            $appointment->save();
            $this->swalAlert('success', 'Awesome', 'Private notes have been saved', "Ok", 1500);
        }
    }


    public function render()
    {
        $appointment = Appointment::findOrFail($this->appointmentId);
        return view('livewire.appointment-notes-save', compact('appointment'));
    }
}
