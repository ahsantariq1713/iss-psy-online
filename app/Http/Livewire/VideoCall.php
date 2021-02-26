<?php

namespace App\Http\Livewire;

use App\Events\EchoEvent;
use App\Helpers\UserRoles;
use App\Models\Appointment;
use App\Models\User;
use App\Traits\SwalEmitter;
use Livewire\Component;
use OpenTok\MediaMode;
use OpenTok\OpenTok;

class VideoCall extends Component
{
    use SwalEmitter;

    public $appointmentId, $accessToken, $userId, $password;
    public $filesChanged = false, $recChanged = false, $hasSidebar = false, $connected = false, $chatChanged = false;

    protected $listeners = ['refreshFiles', 'refreshRecs', 'setMode', 'refreshChat', 'callRejected'];

    public function refreshFiles()
    {
        $this->filesChanged = true;
    }

    public function refreshRecs()
    {
        $this->recChanged = true;
    }

    public function refreshChat()
    {
        $this->chatChanged = true;
    }

    public function callRejected()
    {
        $redirect = route('attend-meeting', ['id' => $this->appointmentId, 'token' => $this->accessToken]);
        $this->swalRedirect('error', 'Meeting Declined', 'Participant rejected the call', $redirect, false);
    }

    public function setMode($mode)
    {
        if ($mode == 'close') {
            $this->hasSidebar = false;
            return null;
        }
        if ($mode == 'files') {
            $this->filesChanged = false;
        } else if ($mode == 'recs') {
            $this->recChanged = false;
        } else if ($mode == 'chat') {
            $this->chatChanged = false;
        }

        $this->hasSidebar = true;
    }


    public function mount($id, $token)
    {
        $this->appointmentId = $id;
        $this->accessToken = $token;
    }

    public function connect()
    {

        $appointment = Appointment::with('therapist', 'client')->find($this->appointmentId);

        if (not($appointment->meetingAllowed())) abort(401);

        $user = $appointment->client->id == $this->userId ? $appointment->client : $appointment->therapist;

        $this->validate(['password' => 'required']);

        if ($user->failPasswordChallenge($this->password)) {
            $this->swalAlert('error', 'Incorrect Password', 'Please enter your password again.', "Ok", 0);
            return null;
        }

        if ($user->role == UserRoles::THERAPIST && is_null($appointment->therapist_attended_at)) {
            $appointment->therapist_attended_at = now();
            $appointment->status = 'Active';
            $appointment->save();
        } else if ($user->role == UserRoles::CLIENT && is_null($appointment->client_attended_at)) {
            $appointment->client_attended_at = now();
            $appointment->status = 'Active';
            $appointment->save();
        }

        if (is_null($appointment->opentok_session_id)) {
            $opentok = new OpenTok(env('OPENTOK_KEY'), env('OPENTOK_SECRET'));
            $session = $opentok->createSession(['mediaMode' => MediaMode::ROUTED]);
            $sessionId = $session->getSessionId();

            $appointment->opentok_token = $opentok->generateToken($sessionId, ['expireTime' => now()->addMinutes(60)->timestamp /*$appointment->end_date->timestamp*/]);
            $appointment->opentok_session_id = $sessionId;

            $appointment->save();
        }

        $this->emit('connect', [
            'seconds' => now()->diffInSeconds($appointment->end_date),
            'key' => env('OPENTOK_KEY'),
            'sessionId' => $appointment->opentok_session_id,
            'token' => $appointment->opentok_token,
            'publisherName' => $user->name,
            'participantImageUrl' => $user->role == UserRoles::THERAPIST ? asset($appointment->client->avatar) : asset($appointment->therapist->avatar),
        ]);

        $this->connected = true;

        $participantId = $user->role == UserRoles::THERAPIST ? $appointment->client_id : $appointment->therapist_id;

        broadcast(new EchoEvent(
            'user' . $participantId,
            'call.received',
            ['caller' => [
                'id' => $user->id,
                'avatar' => $user->avatar,
                'name' => $user->name,
                'appointmentId' => $appointment->id
            ]]
        ));
    }

    public function render()
    {
        $user = null;
        $appointment = Appointment::with('therapist', 'client')->find($this->appointmentId);

        if (not_null($appointment) && $appointment->meetingAllowed()) {
            if ($appointment->client_access_token == $this->accessToken) {
                $user = $appointment->client;
            } else if ($appointment->therapist_access_token == $this->accessToken) {
                $user = $appointment->therapist;
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }

        $this->appointmentId = $appointment->id;
        $this->userId = $user->id;

        return view('livewire.video-call', compact('appointment', 'user'))->extends('layouts.video-call');
    }
}
