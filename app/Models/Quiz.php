<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'title',
        'description',
        'duration',    // in minutes
        'start_time',  // datetime when quiz becomes available
        'end_time',    // datetime when quiz expires
        'status',      // active, draft, etc.
    ];
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];
}
