<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserActivity extends Notification
{
    use Queueable;


    public $sender, $url, $titlePostfix;

    public function __construct($data)
    {
        $this->sender = $data['sender'];
        $this->titlePostfix = $data['titlePostfix'];
        $this->url = $data['url'];
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => $this->titlePostfix,
            'avatar' => $this->sender->avatar,
            'url' => $this->url,
        ];
    }
}
