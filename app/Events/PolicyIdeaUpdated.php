<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PolicyIdeaUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $categories;
    public $policy;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($policy, $categories)
    {
        $this->categories = $categories;
        $this->policy = $policy;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
