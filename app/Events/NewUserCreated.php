<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewUserCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $roles;

    /**
     * Create a new event instance.
     * @param User $user, Array roles
     *
     * @return void
     */
    public function __construct($user, $roles)
    {
        $this->user = $user;
        $this->roles = $roles;
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
