<?php

namespace App\Listeners;

use App\Events\NewPolicyIdeaSubmitted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class SendEmailNotificationToIdeaOwner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
       //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NewPolicyIdeaSubmitted  $event
     * @return void
     */
    public function handle(NewPolicyIdeaSubmitted $event)
    {
        $details = [
            'title' => 'You Policy idea has been submitted',
            'body' => 'Thanks for subbmitting a policy idea for review. This is the first step to get your voice heard.
                        Other stages of the process are:
                        <ul>
                            <li>Our moderators will review your submission and approve if it is in line with NNDCA vision</li>
                            <li>Once approve, it will be forwarded to NNDCA forum for further discussions and modifications by members</li>
                            <li>Your submission will also be upvoted or down voted by members.</li>
                            <li>Once it has passed the treshold vote, the policy will be accepted and available to the general public.</li>
                        </ul>',
            'subject' => $event->policy->title,
            'footer' => 'To have a chance to follow the discussion on your policy submission, consider registering to join NNDCA at '.url('/').'/register',
            'view' => 'mail.standard-notification',
            ];
            Mail::to($event->policy->email)->send(new SendMail($details));
    }
}
