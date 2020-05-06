<?php

namespace App\Domain\Aggregators\Project;

use App\Events\ProjectCreatedEvent;

class ProjectAggregateRoot
{
    use ProjectStartDateAggregate, ProjectGenerateUUIDAggregate, ProjectTitleUpdatedAggregate, ProjectDealUpdatedAggregate;

    public $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function store() {
        $this->generateUUID();
        $this->addDefaultDate();
        // ...
        event(new ProjectCreatedEvent($this->attributes));
        return $this->attributes['uuid'];
    }

    public function update() {
        $this->titleUpdated();
        $this->dealAmountUpdated();
    }

    public function delete() {

    }

}
