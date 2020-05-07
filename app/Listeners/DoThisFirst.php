<?php

namespace App\Listeners;

use App\Events\SyncEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DoThisFirst implements ShouldQueue
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
     * @param  SyncEvent  $event
     * @return void
     */
    public function handle(SyncEvent $event)
    {
        dump(1);
        sleep(30);

    }
}
