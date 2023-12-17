<?php

namespace App\Models;

use App\Models\Concerns\CreatesRedirects;
use App\Models\Concerns\TracksUserUpdates;
use App\Observers\EventObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    use CreatesRedirects,
        HasFactory,
        TracksUserUpdates;

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
        'elexio_id' => 'integer',
        'elexio_updated_at' => 'datetime',
    ];

    /**
     * Interact with the event slug attribute.
     */
    protected function slug(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Str::plural(strtolower(class_basename($this))).'/'.$value,
        );
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Determine if the event has passed.
     */
    public function hasPassed(): bool
    {
        if ($this->ends_at) {
            return $this->ends_at->isPast();
        }

        // Check if it's the end of the day for all day events.
        if ($this->starts_at->isStartOfDay()) {
            return $this->starts_at->endOfDay()->isPast();
        }

        return $this->starts_at->isPast();
    }

    /**
     * Scope a query to only include events that are upcoming.
     */
    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('starts_at', '>=', now());
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
