<?php


namespace App\Domain\Aggregators\Project;


use Carbon\Carbon;

trait ProjectStartDateAggregate
{
    public function addDefaultDate() {
        $this->attributes['start_date'] = Carbon::now();
    }
}
