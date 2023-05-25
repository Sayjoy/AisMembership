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
    public function handle($event)
    {
        Mail::to($event->policy->email)->send(new SendMail($event->mail_details));
    }
}
