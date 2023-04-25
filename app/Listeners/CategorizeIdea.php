<?php

namespace App\Listeners;

use App\Events\NewPolicyIdeaSubmitted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CategorizeIdea
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
        $event->policy->categories()->sync($event->categories);
    }
}
