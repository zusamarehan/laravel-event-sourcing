<?php


namespace App\Domain\Aggregators\Project;


use Illuminate\Support\Str;

trait ProjectGenerateUUIDAggregate
{
    public function generateUUID() {
        $this->attributes['uuid'] = Str::uuid();
    }
}
