<?php

namespace App\Models;

use App\Models\Concerns\TracksUserUpdates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Meeting extends Model
{
    use HasFactory,
        TracksUserUpdates;

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'meeting_date' => 'datetime',
    ];

    /**
     * The meeting topic that the meeting belongs to.
     */
    public function meetingTopic(): BelongsTo
    {
        return $this->belongsTo(MeetingTopic::class);
    }
}
