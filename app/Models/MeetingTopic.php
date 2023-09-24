<?php

namespace App\Models;

use App\Models\Concerns\CreatesRedirects;
use App\Observers\MeetingTopicObserver;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MeetingTopic extends Model
{
    use HasFactory,
        CreatesRedirects;

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::observe(MeetingTopicObserver::class);
    }

    /**
     * Interact with the event slug attribute.
     */
    protected function slug(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => 'resources/topic/'.$value,
        );
    }

    /**
     * The meetings that belong to the meeting topic.
     */
    public function meetings(): HasMany
    {
        return $this->hasMany(Meeting::class);
    }

    /**
     * The last user to update the meeting topic.
     */
    public function lastUpdatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }
}
