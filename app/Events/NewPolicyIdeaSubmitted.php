<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewPolicyIdeaSubmitted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $categories;
    public $policy;
    public $mail_details;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($policy, $categories)
    {
        $this->categories = $categories;
        $this->policy = $policy;
        $this->mail_details = [
            'title' => 'Your Policy idea has been submitted',
            'body' => 'Thanks for submitting a policy idea for review. This is the first step to get your voice heard.
                        Other stages of the process are:
                        <ul>
                            <li>Our moderators will review your submission and approve if it is in line with NNDCA vision</li>
                            <li>Once approved, it will be forwarded to NNDCA forum for further discussions by members</li>
                            <li>Our moderators will review member comments and modify your idea accordingly until it becomes a full blown policy.</li>
                            <li>After this, the policy will be published to the public.</li>
                        </ul>',
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
