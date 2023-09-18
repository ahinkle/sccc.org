<?php

namespace App\Models;

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
     * The speakers of the message.
     */
    public function speakers(): BelongsToMany
    {
        return $this->belongsToMany(Person::class, AssignedMessageSpeaker::class, 'message_id', 'speaker_id')
            ->withTimestamps();
    }
}
