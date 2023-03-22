<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $messsage;
    public function __construct($messsage)
    {
        $this->messsage = $messsage;
    }

    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');
        return ['notif-partner'];
    }

    public function broadcastAs()
    {
        return 'my-event';
    }
}
