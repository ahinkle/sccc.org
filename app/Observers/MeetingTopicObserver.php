<?php

namespace App\Observers;

use App\Models\MeetingTopic;
use Illuminate\Support\Str;

class MeetingTopicObserver
{
    /**
     * Handle the MeetingTopic "saving" event.
     */
    public function saving(MeetingTopic $meetingTopic): void
    {
        $meetingTopic->slug = Str::slug($meetingTopic->name);
    }
}
