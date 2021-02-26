<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AppointmentDataChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $appointmentId, $listnerName;

    public function __construct($appointmentId, $listnerName)
    {
        $this->appointmentId = $appointmentId;
        $this->listnerName = $listnerName;
    }

    public function broadcastAs(){
        return $this->listnerName;
    }

    public function broadcastOn()
    {
        return ['appointment' . $this->appointmentId];
    }
}
