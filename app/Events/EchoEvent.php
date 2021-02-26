<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EchoEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $channel, $event, $data;
    public function __construct($channel, $event, $data = null)
    {
        $this->channel = $channel;
        $this->event = $event;
        $this->data = $data;
    }

    public function broadcastAs(){
        return $this->event;
    }

    public function broadcastOn()
    {
        return [$this->channel];
    }
}
