<?php

namespace App\Models;

use App\Observers\MeetingObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Meeting extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'meeting_date' => 'datetime',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::observe(MeetingObserver::class);
    }

    /**
     * The meeting topic that the meeting belongs to.
     */
    public function meetingTopic(): BelongsTo
    {
        return $this->belongsTo(MeetingTopic::class);
    }

    /**
     * The last user to update the meeting topic.
     */
    public function lastUpdatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }
}
