<?php

namespace App\Models;

use App\Enums\EventFrequency;
use App\Models\Concerns\CreatesRedirects;
use App\Models\Concerns\TracksUserUpdates;
use App\Observers\EventObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory,
        CreatesRedirects,
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
        'repeat_frequency' => EventFrequency::class,
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
     * Determine if the event has passed.
     */
    public function hasPassed(): bool
    {
        if ($this->ends_at) {
            return $this->ends_at->isPast();
        }

        // Check if it's the end of the day for all day events.
        if ($this->starts_at === $this->starts_at->startOfDay()) {
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

    /**
     * Get the next occurance of the event.
     */
    public function nextOccurance(): ?Carbon
    {
        if (! $this->repeat_frequency) {
            return null;
        }

        return $this->repeat_frequency->nextOccurance($this->starts_at);
    }
}
