<?php

namespace App\Http\Livewire;

use App\Events\AppointmentDataChanged;
use App\Events\MeetingFilesRefreshed;
use App\Helpers\DocumentStorage;
use App\Models\Appointment;
use App\Models\AppointmentFile;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class VideoCallSidebar extends Component
{

    use WithFileUploads;

    public $appointmentId, $userId, $file, $recs, $notes, $mode;

    protected $listeners = ['refreshFiles', 'setMode', 'refreshRecs'];
    public function refreshFiles(){}
    public function setMode($mode){
        $this->mode = $mode;
    }
    public function refreshRecs(){}

    public function updated($property)
    {
        switch ($property) {
            case 'file':
                $this->saveFile();
                break;
            case 'recs':
                $this->saveRecs();
                break;
            case 'notes':
                $this->saveNotes();
                break;
        }
    }

    public function download($id)
    {
        $file = AppointmentFile::find($id);

        $allowed =
            not_null($file)
            && ($this->userId == $file->appointment->client->id || $this->userId == $file->appointment->therapist->id);

        if ($allowed) {
            return Storage::disk('local')->download($file->file);
        }

    }

    public function delete($id)
    {
        $file = AppointmentFile::find($id);

        $allowed =
            not_null($file)
            && ($this->userId == $file->user->id)
            && $file->appointment->allowUpdate();

        if ($allowed) {
            Storage::disk('local')->delete($file['file']);
            AppointmentFile::where('id', $file['id'])->delete();
            broadcast(new AppointmentDataChanged($this->appointmentId,'refresh.files'))->toOthers();
        }
    }

    public function saveRecs(){
         $appointment = Appointment::find($this->appointmentId);
         $allowed = $this->userId == $appointment->therapist->id && $appointment->allowUpdate();
         if($allowed){
            $appointment->recommendations = $this->recs;
            $appointment->save();
            broadcast(new AppointmentDataChanged($this->appointmentId,'refresh.recs'))->toOthers();
         }
    }

    public function saveNotes(){
        $appointment = Appointment::find($this->appointmentId);
        $allowed = $this->userId == $appointment->therapist->id && $appointment->allowUpdate();
        if($allowed){
           $appointment->notes = $this->notes;
           $appointment->save();
        }
   }

    private function saveFile()
    {

        $appointment = Appointment::find($this->appointmentId);
        if (is_null($appointment) || not($appointment->allowUpdate())) {
            return null;
        }

        $file_name = $this->file->getClientOriginalName();

        $appointment_file = new AppointmentFile([
            'title' => $file_name,
        ]);

        DocumentStorage::store($appointment_file, 'file', $this->file, $this->userId);

        $appointment_file->user_id = $this->userId;
        $appointment_file->appointment_id = $this->appointmentId;
        $appointment_file->save();

        broadcast(new AppointmentDataChanged($this->appointmentId,'refresh.files'))->toOthers();
    }

    public function render()
    {
        $user = User::find($this->userId);
        $appointment = Appointment::with('therapist', 'client', 'files')->find($this->appointmentId);
        return view('livewire.video-call-sidebar', compact('user', 'appointment'));
    }
}
