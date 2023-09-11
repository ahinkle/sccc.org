<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Message extends Model
{
    use HasFactory;

    /**
     * The speakers of the message.
     */
    public function speakers(): HasManyThrough
    {
        return $this->hasManyThrough(Person::class, AssignedMessageSpeaker::class);
    }
}
