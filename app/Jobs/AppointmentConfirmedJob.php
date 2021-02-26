<?php

namespace App\Jobs;

use App\Events\EchoEvent;
use App\Models\Appointment;
use App\Notifications\AppointmentConfirmedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class AppointmentConfirmedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }


    public function handle()
    {
        $this->notifyUser($this->appointment->therapist);
        $this->notifyUser($this->appointment->client);
    }

    public function notifyUser($user)
    {
        $notification = new AppointmentConfirmedNotification($this->appointment, $user);

        Notification::route('mail', $user->email)->notify($notification);
        if(not_null($user->phone_verified_at)){
            Notification::route('nexmo', $user->phone)->notify($notification);
        }

        broadcast(new EchoEvent('user' . $user->id, 'refresh.nav'));
    }
}
