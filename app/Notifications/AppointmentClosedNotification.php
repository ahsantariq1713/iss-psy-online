<?php

namespace App\Notifications;

use App\Events\EchoEvent;
use App\Helpers\UserRoles;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class AppointmentClosedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        return ['mail', 'nexmo', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line("Your appointment # " . $this->appointment->id . " is marked as " . $this->appointment->status)
            ->action('Notification Action', $this->getAppointmentUrl())
            ->line('Thanks again for choosing Psychologists Online.');
    }

    public function toNexmo($notifiable)
    {
        return (new NexmoMessage())
            ->content(
                "Your appointment # " . $this->appointment->id . " is marked as " . $this->appointment->status .
                    "please follow the link to see more details " . $this->getAppointmentUrl() .
                    "Thanks again for choosing Psychologists Online."
            )
            ->from('+923047430053');
    }

    public function toArray($notifiable)
    {
        return [
            'title' => "Your appointment # " . $this->appointment->id . " is marked as " . $this->appointment->status,
            'avatar' => null,
            'url' => $this->getAppointmentUrl()
        ];
    }

    private function getAppointmentUrl()
    {
        return route('appointment-show', [$this->appointment->id]);
    }
}
