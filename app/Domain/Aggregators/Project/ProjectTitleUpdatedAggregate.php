<?php


namespace App\Domain\Aggregators\Project;


use App\Events\ProjectTitleUpdatedEvent;

trait ProjectTitleUpdatedAggregate
{
    public function titleUpdated() {
        event(new ProjectTitleUpdatedEvent(['uuid' => $this->attributes['uuid'], 'title' => $this->attributes['title']]));
    }
}
