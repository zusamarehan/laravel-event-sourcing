<?php

namespace App\Jobs;

use App\Events\ProjectCreatedEvent;
use App\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProjectorProjectCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $attributes;

    /**
     * Create a new job instance.
     *
     * @param ProjectCreatedEvent $event
     */
    public function __construct(ProjectCreatedEvent $event)
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
        $project = new Project;
        $project->uuid = $this->attributes['uuid'];
        $project->title = $this->attributes['title'];
        $project->deal_amount = $this->attributes['deal'];
        $project->save();
    }
}
