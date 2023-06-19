<?php

namespace App\Listeners;

use App\Events\NewUserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AssignWorkgroups
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
     * @param  $event
     * @return void
     */
    public function handle($event)
    {
        if (!empty($event->workgroups))
            $event->user->workgroups()->sync($event->workgroups);
    }
}
