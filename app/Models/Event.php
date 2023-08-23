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
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'repeat_frequency' => EventFrequency::class,
    ];

    /**
     * Scope a query to only include events that are upcoming.
     */
    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('starts_at', '>=', today());
    }

    /**
     * Scope a query to only include recurring events.
     */
    public function scopeRecurring(Builder $query): Builder
    {
        return $query->whereNotNull('repeat_frequency');
    }

    /**
     * Scope a query to only include events that have started.
     */
    public function scopeHasStarted(Builder $query): Builder
    {
        return $query->where('starts_at', '<=', now());
    }

    /**
     * Scope a query to only include events that have not ended.
     */
    public function scopeNotEnded(Builder $query): Builder
    {
        return $query->where(function (Builder $query) {
            $query->whereNull('ends_at')
                ->orWhere('ends_at', '>=', now());
        });
    }
}
