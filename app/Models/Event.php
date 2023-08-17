<?php

namespace App\Models;

use App\Enums\EventFrequency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'repeat_frequency' => EventFrequency::class,
    ];
}
