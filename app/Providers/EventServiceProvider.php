<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\NewUserCreated;
use App\Events\NewPolicyIdeaSubmitted;
use App\Events\PolicyIdeaUpdated;
use App\Events\PolicyIdeaStatusUpdated;
use App\Events\PolicyPublishedStatus;
use App\Listeners\AssignRoles;
use App\Listeners\CategorizeIdea;
use App\Listeners\SendEmailNotificationToIdeaOwner;
use App\Listeners\SendEmailNotificationToModerators;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NewUserCreated::class => [
            AssignRoles::class,
        ],
        NewPolicyIdeaSubmitted::class => [
            CategorizeIdea::class,
            SendEmailNotificationToIdeaOwner::class,
            SendEmailNotificationToModerators::class,
        ],
        PolicyIdeaUpdated::class => [
            CategorizeIdea::class
        ],
        PolicyIdeaStatusUpdated::class => [
            SendEmailNotificationToIdeaOwner::class,
        ],
        PolicyPublishedStatus::class => [
            SendEmailNotificationToIdeaOwner::class,
        ],
    ];
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
