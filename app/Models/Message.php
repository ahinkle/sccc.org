<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'message_date' => 'datetime',
    ];

    /**
     * Interact with the YouTube URL accessor.
     */
    protected function youtubeUrl(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => 'https://youtu.be/'.$value,
        );
    }

    /**
     * The speakers of the message.
     */
    public function speakers(): BelongsToMany
    {
        return $this->belongsToMany(Person::class, AssignedMessageSpeaker::class, 'message_id', 'speaker_id')
            ->withTimestamps();
    }
}
