<?php

namespace App\Jobs;

use App\Events\ProjectDealUpdatedEvent;
use App\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProjectorProjectUpdateDealJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $attributes;

    /**
     * Create a new job instance.
     *
     * @param ProjectDealUpdatedEvent $event
     */
    public function __construct(ProjectDealUpdatedEvent $event)
    {
        $this->attributes = $event->attributes;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $project = Project::where('uuid', $this->attributes['uuid'])->first();
        $project->deal_amount = $this->attributes['deal_amount'];
        $project->update();
    }
}
