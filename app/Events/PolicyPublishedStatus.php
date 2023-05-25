<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PolicyPublishedStatus
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $policy;
    public $mail_details;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($policy, $message)
    {
        $this->policy = $policy;
        $this->mail_details = [
            'title' => 'Your Policy Published Status has been updated',
            'body' => $message,
            'subject' => $policy->title,
            'footer' => 'To have a chance to follow the discussion on your policy submission, consider registering to join NNDCA at '.url('/').'/register',
            'view' => 'mail.standard-notification',
            ];
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
