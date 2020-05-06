<?php

namespace App\Listeners;

use App\EventLogs;
use App\Events\ProjectDealUpdatedEvent;
use App\Jobs\ProjectorProjectUpdateDealJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;

class ProcessProjectUpdateDealListener
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
     * @param ProjectDealUpdatedEvent $event
     * @return void
     */
    public function handle(ProjectDealUpdatedEvent $event)
    {
        $eventLog = new EventLogs;
        $eventLog->uuid = Str::uuid();
        $eventLog->action = 'UPDATE';
        $eventLog->module = 'Project';
        $eventLog->attributes = $event->attributes;
        $eventLog->field = 'deal_amount';
        $eventLog->save();

        ProjectorProjectUpdateDealJob::dispatch($event);
    }
}
