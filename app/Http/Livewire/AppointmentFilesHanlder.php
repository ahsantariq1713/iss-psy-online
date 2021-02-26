<?php

namespace App\Http\Livewire;

use App\Events\AppointmentDataChanged;
use App\Helpers\DocumentStorage;
use App\Models\Appointment;
use App\Models\AppointmentFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class AppointmentFilesHanlder extends Component
{
    use WithFileUploads;

    public $appointmentId, $file;

    public function updated($property)
    {
        switch ($property) {
            case 'file':
                $this->saveFile();
                break;
        }
    }

    public function render()
    {
        $appointment = Appointment::with('therapist', 'client', 'files')->find($this->appointmentId);
        return view('livewire.appointment-files-hanlder', compact('appointment'));
    }

    public function download($id)
    {
        $file = AppointmentFile::find($id);

        $allowed =
            not_null($file)
            && (Auth::id() == $file->appointment->client->id || Auth::id() == $file->appointment->therapist->id || Auth::user()->isAdmin());

        if ($allowed) {
            return Storage::disk('local')->download($file->file);
        }

    }

    public function delete($id)
    {
        $file = AppointmentFile::find($id);

        $allowed =
            not_null($file)
            && (Auth::id() == $file->user->id)
            && $file->appointment->allowUpdate();

        if ($allowed) {
            Storage::disk('local')->delete($file['file']);
            AppointmentFile::where('id', $file['id'])->delete();
            broadcast(new AppointmentDataChanged($this->appointmentId,'refresh.files'))->toOthers();
        }
    }

    private function saveFile()
    {
        $appointment = Appointment::find($this->appointmentId);

        if (Auth::user()->isAdmin() || is_null($appointment) || not($appointment->allowUpdate())) {
            return null;
        }

        $file_name = $this->file->getClientOriginalName();

        $appointment_file = new AppointmentFile([
            'title' => $file_name,
        ]);

        DocumentStorage::store($appointment_file, 'file', $this->file, Auth::id());

        $appointment_file->user_id = Auth::id();
        $appointment_file->appointment_id = $this->appointmentId;
        $appointment_file->save();

        broadcast(new AppointmentDataChanged($this->appointmentId,'refresh.files'))->toOthers();
    }
}
