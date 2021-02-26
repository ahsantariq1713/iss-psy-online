<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $conversationId, $event, $messgeId;

    public function __construct($conversationId, $event, $messgeId)
    {
        $this->conversationId = $conversationId;
        $this->event = $event;
        $this->messgeId = $messgeId;
    }

    public function broadcastAs()
    {
        return $this->event;
    }

    public function broadcastOn()
    {
        return ['chat' . $this->conversationId];
    }
}
