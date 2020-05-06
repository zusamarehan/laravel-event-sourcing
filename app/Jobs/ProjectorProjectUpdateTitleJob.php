<?php

namespace App\Jobs;

use App\Events\ProjectCreatedEvent;
use App\Events\ProjectTitleUpdatedEvent;
use App\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProjectorProjectUpdateTitleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $attributes;

    /**
     * Create a new job instance.
     *
     * @param ProjectTitleUpdatedEvent $event
     */
    public function __construct(ProjectTitleUpdatedEvent $event)
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
        $project->title = $this->attributes['title'];
        $project->update();
    }
}
