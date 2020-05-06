<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventLogs extends Model
{
    //
    protected $casts = [
        'attributes' => 'array'
    ];
}
