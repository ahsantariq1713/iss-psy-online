<?php

namespace App\Jobs;

use App\Events\EchoEvent;
use App\Helpers\UserRoles;
use App\Models\Appointment;
use App\Models\User;
use App\Notifications\AppointmentClosedNotification;
use App\Notifications\UserActivity;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AppointmentClosedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

   public $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function handle()
    {
        $this->updateStatus();
        $this->notifyUser($this->appointment->client);
        $this->notifyUser($this->appointment->therapist);
    }

    public function updateStatus()
    {
        if ($this->appointment->status == 'Active') {
            if (is_null($this->appointment->therapist_attended_at)) {
                $this->appointment->status = 'Cancelled';
            } else {
                $this->appointment->status = 'Completed';
            }

            $this->appointment->save();
        }
    }

    public function notifyUser(User $user)
    {
        $user->notify(new AppointmentClosedNotification($this->appointment));
        broadcast(new EchoEvent('user' . $user->id, 'refresh.nav'))->toOthers();
    }
}
