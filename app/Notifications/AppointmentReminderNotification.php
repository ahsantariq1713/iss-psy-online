<?php

namespace App\Notifications;

use App\Helpers\UserReadable;
use App\Models\Appointment;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;

class AppointmentReminderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $appointment, $user;

    public function __construct(Appointment $appointment, $user)
    {
        $this->appointment = $appointment;
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ["mail", "nexmo", "database"];
    }


    public function toMail($notifiable)
    {

        return (new MailMessage)
            ->line("This is a friendly reminder that your appointment is set to commence on " .$this->getStartDate())
            ->action("Show Appointment", $this->getAppointmentUrl())
            ->line("Please make sure you have checked and tested your audio and video settings to interact
                                efficiently and to make your experience more enjoyable.")
            ->line($this->getNote())
            ->line("Thanks again for choosing Psychologists Online!");
    }

    public function toNexmo($notifiable)
    {

        if (is_null($this->user->phone_verified_at)) {
            return null;
        }

        return (new NexmoMessage)
            ->content(
                "This is a friendly reminder that your appointment is set to commence on " . $this->getStartDate().
                    "All the information you need for your appointment is available here " . $this->getAppointmentUrl() .
                    "Please make sure you have checked and tested your audio and video settings to interact efficiently
                    and to make your experience more enjoyable."
                    . $this->getNote() .
                    "Thanks again for choosing Psychologists Online!"
            )
            ->from("+923047430053");
    }


    public function toArray($notifiable)
    {
        return [
            "title" => "Your appointment # " . $this->appointment->id . " is set to commence on " . $this->getStartDate(),
            "avatar" => null,
            "url" => $this->getAppointmentUrl()
        ];
    }

    private function getNote()
    {
        if ($this->user->isTherapist()) {
            return "Please note: If you miss your appointment, you will be charged a $10 cancellation fee due to being outside our “cancellation without fees policy” period.
                The client will also have the right to leave a bad review, damaging your reputation and ours, so your attention to this matter is much appreciated.";
        } else {
            return
                "Please note: We do not grant refunds for technical issues related to your internet connection audio or video issues,
                or if you forgot your appointment, so your attention to this matter is much appreciated.";
        }
    }


    private function getStartDate()
    {
        return UserReadable::sessionDate($this->appointment->start_date, $this->user->timezone)->format("d M, Y h:i A");
    }


    private function getAppointmentUrl()
    {
        return route('appointment-show', [$this->appointment->id]);
    }
}
