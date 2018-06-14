<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class InterventionSent  implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $ambulance;

    public $message;



    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($ambulance)
    {
        $this->ambulance = $ambulance;
        $this->message  = "{$ambulance} sent intervention";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['intervention-sent'];
    }
}
