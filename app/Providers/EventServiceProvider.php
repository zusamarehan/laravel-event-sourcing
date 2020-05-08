<?php

namespace App\Providers;

use App\Events\ProjectCreatedEvent;
use App\Events\ProjectDealUpdatedEvent;
use App\Events\ProjectTitleUpdatedEvent;
use App\Events\SyncEvent;
use App\Listeners\DoThisFirst;
use App\Listeners\DoThisSecond;
use App\Listeners\DoThisThird;
use App\Listeners\ProcessProjectCreateListener;
use App\Listeners\ProcessProjectUpdateDealListener;
use App\Listeners\ProcessProjectUpdateTitleListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ProjectCreatedEvent::class => [
            ProcessProjectCreateListener::class
        ],
        ProjectDealUpdatedEvent::class => [
            ProcessProjectUpdateDealListener::class
        ],
        ProjectTitleUpdatedEvent::class => [
            ProcessProjectUpdateTitleListener::class
        ],
        SyncEvent::class => [
            DoThisFirst::class,
            DoThisSecond::class,
            DoThisThird::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
