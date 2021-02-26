<?php

namespace App\Notifications;

use App\Helpers\UserReadable;
use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class AppointmentStartedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $appointment, $user;

    public function __construct(Appointment $appointment, $user)
    {
        $this->appointment = $appointment;
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail', 'nexmo', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Your appointment is started please follow the link to join meeting:')
            ->action('Attend Meeting', $this->getMeetingUrl())
            ->line('Please make sure you have checked and tested your audio and video settings to interact efficiently and to make your experience more enjoyable.')
            ->line($this->getNote())
            ->line('Thanks again for choosing Psychologists Online.');
    }

    public function toNexmo($notifiable)
    {
        return (new NexmoMessage())
            ->content(
                "Your appointment is started please follow the link to join meeting: " . $this->getMeetingUrl().
                 " Please make sure you have checked and tested your audio and video settings to interact efficiently and to make your experience more enjoyable."
                 . $this->getNote() .
                 " Thanks again for choosing Psychologists Online."
            )
            ->from('+923047430053');
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Your appointment # ' . $this->appointment->id . ' is started.',
            'avatar' => null,
            'url' => $this->getMeetingUrl()
        ];
    }

    private function getNote()
    {
        if ($this->user->isTherapist()) {
            return 'Please note, If you miss your appointment, you will be charged a $10 cancellation fee due to being outside our “cancellation without fees policy” period. The client will also have the right to leave a bad review, damaging your reputation and ours, so your attention to this matter is much appreciated.';
        } else {
            return
                'Please note, We do not grant refunds for technical issues related to your internet connection audio or video issues, or if you forgot your appointment, so your attention to this matter is much appreciated.';
        }
    }

    private function  getToken(){
        return $this->user->isTherapist() ? $this->appointment->therapist_access_token : $this->appointment->client_access_token;
    }

    private function getMeetingUrl(){
       return route('attend-meeting', ['id' => $this->appointment->id, 'token' => $this->getToken()]);
    }
}
