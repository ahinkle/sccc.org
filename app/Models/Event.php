<?php

namespace App\Models;

use App\Enums\EventFrequency;
use App\Models\Concerns\CreatesRedirects;
use App\Observers\EventObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory,
        CreatesRedirects;

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::observe(EventObserver::class);
    }

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'event_start' => 'datetime',
        'event_end' => 'datetime',
        'repeat_frequency' => EventFrequency::class,
    ];

    /**
     * Scope a query to only include events that are upcoming.
     */
    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('event_start', '>=', today());
    }
}
