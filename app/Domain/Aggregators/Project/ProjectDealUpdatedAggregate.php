<?php


namespace App\Domain\Aggregators\Project;


use App\Events\ProjectDealUpdatedEvent;

trait ProjectDealUpdatedAggregate
{
    public function dealAmountUpdated() {
        event(new ProjectDealUpdatedEvent(['uuid' => $this->attributes['uuid'], 'deal_amount' => $this->attributes['deal']]));
    }
}
