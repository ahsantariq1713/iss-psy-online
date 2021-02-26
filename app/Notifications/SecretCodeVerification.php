<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class SecretCodeVerification extends Notification
{
    use Queueable;

    public $payload, $title;

    public function __construct($payload, $title)
    {
        $this->payload = $payload;
        $this->title = $title;
    }

    public function via($notifiable)
    {
        return ['mail', 'nexmo'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->title)
            ->line('We received a ' . $this->title . ' Request from your account.')
            ->line($this->payload)
            ->line('Use this code to complete ' . strtolower($this->title) . '.');
    }

    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
            ->content('Use this code ' . $this->payload . ' as your Psychologists Online ' . $this->title . ' Request Code.')
            ->from('+923047430053');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
