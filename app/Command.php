<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    //
    protected $casts = [
        'attributes' => 'array'
    ];
}
