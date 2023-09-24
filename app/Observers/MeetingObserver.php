<?php

namespace App\Observers;

use App\Models\Meeting;

class MeetingObserver
{
    /**
     * Handle the Meeting "saving" event.
     */
    public function saving(Meeting $meeting): void
    {
        $meeting->updated_by_id ??= auth()->id();
    }
}
