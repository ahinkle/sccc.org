<?php

namespace App\Observers;

use App\Models\MeetingTopic;
use Illuminate\Support\Str;

class MeetingTopicObserver
{
    /**
     * Handle the MeetingTopic "created" event.
     */
    public function saving(MeetingTopic $meetingTopic): void
    {
        $meetingTopic->updated_by_id ??= auth()->id();
        $meetingTopic->slug = Str::slug($meetingTopic->name);
    }
}
