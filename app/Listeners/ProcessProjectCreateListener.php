<?php

namespace App\Listeners;

use App\EventLogs;
use App\Events\ProjectCreatedEvent;
use App\Jobs\ProjectorProjectCreateJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;

class ProcessProjectCreateListener
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
     * @param ProjectCreatedEvent $event
     * @return void
     */
    public function handle(ProjectCreatedEvent $event)
    {
        $eventLog = new EventLogs;
        $eventLog->uuid = Str::uuid();
        $eventLog->action = 'CREATE';
        $eventLog->module = 'Project';
        $eventLog->attributes = $event->attributes;
        $eventLog->save();

        ProjectorProjectCreateJob::dispatch($event);
    }
}
