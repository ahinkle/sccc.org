<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Person extends Model
{
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'is_staff' => 'boolean',
        ];
    }

    /**
     * Interact with the staff image attribute.
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value
                ? asset('storage/'.$value)
                : 'https://via.placeholder.com/640x480?text=Coming+Soon',
        );
    }

    /**
     * Scope a query to only include staff members.
     */
    public function scopeStaff(Builder $query): Builder
    {
        return $query->where('is_staff', true);
    }

    /**
     * The messages that the person has been assigned to.
     */
    public function messages(): HasManyThrough
    {
        return $this->hasManyThrough(Message::class, AssignedMessageSpeaker::class, 'speaker_id', 'id', 'id', 'message_id');
    }
}
