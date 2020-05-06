<?php

namespace App\Listeners;

use App\EventLogs;
use App\Events\ProjectTitleUpdatedEvent;
use App\Jobs\ProjectorProjectUpdateTitleJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;

class ProcessProjectUpdateTitleListener
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
     * @param ProjectTitleUpdatedEvent $event
     * @return void
     */
    public function handle(ProjectTitleUpdatedEvent $event)
    {

        $eventLog = new EventLogs;
        $eventLog->uuid = Str::uuid();
        $eventLog->action = 'UPDATE';
        $eventLog->module = 'Project';
        $eventLog->attributes = $event->attributes;
        $eventLog->field = 'title';
        $eventLog->save();

        ProjectorProjectUpdateTitleJob::dispatch($event);
    }
}
