<?php

namespace App\Notifications;

use App\Helpers\NotificationData;
use App\Helpers\UserReadable;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class AppointmentConfirmedNotification extends Notification
{
    use Queueable;

    private $appointment, $user;

    public function __construct(Appointment $appointment, User $user)
    {
        $this->appointment = $appointment;
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail', 'nexmo'];
    }

    public function toMail($notifiable)
    {
        if ($this->user->isTherapist()) {
            return (new MailMessage)
                ->line('Congratulations on your booking!')
                ->line($this->appointment->client->name . ' has booked ' . $this->getDuration() . ' hours with you.')
                ->line('Your patient is looking forward to meeting you on ' . $this->getStartDate())
                ->line('All the information you need for your appointment is available here')
                ->action('Show Appointment', $this->getAppointmentUrl())
                ->line('Thank you for choosing Psychologists Online!');
        } else {
            return (new MailMessage)
                ->line('Congratulations on your appointment!')
                ->line('You’ve booked  ' . $this->getDuration() . ' Hrs therapy session with ' . $this->appointment->therapist->name)
                ->line('Your patient is looking forward to meeting you on ' . $this->getStartDate())
                ->line('All the information you need for your appointment is available here')
                ->action('Show Appointment', $this->getAppointmentUrl())
                ->line('Thank you for choosing Psychologists Online!');
        }
    }

    public function toNexmo($notifiable)
    {
        if ($this->user->isTherapist()) {
            return (new NexmoMessage)
                ->content('Congratulations on your booking! ' .
                    $this->appointment->client->name . ' has booked ' . $this->getDuration() . ' hours with you. ' .
                    'Your patient is looking forward to meeting you  on ' . $this->getStartDate() .
                    '. All the information you need for your appointment is available here ' . $this->getAppointmentUrl() .
                    'Thank you for choosing Psychologists Online!')
                ->from('+923047430053');
        } else {
            return (new NexmoMessage)
                ->content('Congratulations on your appointment! ' .
                    'You have booked ' . $this->getDuration() . ' Hrs therapy session with ' . $this->appointment->therapist->name .
                    'Your therapist is looking forward to meeting you on ' . $this->getStartDate() .
                    'All the information you need for your appointment is available here ' . $this->getAppointmentUrl() .
                    'Thank you for choosing Psychologists Online!')
                ->from('+923047430053');
        }
    }


    public function toArray($notifiable)
    {
        return [
            'title' => "Congratulations! Your appointment # " . $this->appointment->id . " is confirmed.",
            'avatar' => null,
            'url' => $this->getAppointmentUrl()
        ];
    }

    private function getStartDate()
    {
        return UserReadable::sessionDate($this->appointment->start_date, $this->user->timezone)->format('d M, Y h:i A');
    }

    private function getDuration()
    {
        return $this->appointment->therapist->roster->durationHours();
    }

    private function getAppointmentUrl()
    {
        return route('appointment-show', [$this->appointment->id]);
    }
}
