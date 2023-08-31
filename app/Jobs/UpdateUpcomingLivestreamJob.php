<?php

namespace App\Jobs;

use Alaouy\Youtube\Facades\Youtube;
use App\Mail\Livestream\FailedToLocateLivestream;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UpdateUpcomingLivestreamJob implements ShouldQueue
{
    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $upcoming = collect(Youtube::searchAdvanced([
            'type' => 'video',
            'eventType' => 'upcoming',
            'part' => 'id, snippet',
            'channelId' => config('youtube.channel_id'),
            'maxResults' => 50,
        ]));

        if ($upcoming->count() === 0) {
            Mail::queue(new FailedToLocateLivestream(
                sunday: $this->nextSunday(),
                wednesday: $this->nextWednesday(),
                videos: collect(),
                tries: $this->attempts(),
            ));

            throw new \Exception('No upcoming livestreams found.');
        }

        $sunday = $upcoming->filter(fn ($item) => Str::contains($item->snippet->title, $this->nextSunday()->format('l, F j, Y')));

        if ($sunday->count() > 0) {
            cache()->put('livestream.sunday', $sunday->first()->id->videoId, now()->addWeek());
        }

        $wednesday = $upcoming->filter(fn ($item) => Str::contains($item->snippet->title, $this->nextWednesday()->format('l, F j, Y')));

        if ($wednesday->count() > 0) {
            cache()->put('livestream.wednesday', $wednesday->first()->id->videoId, now()->addWeek());
        }

        if ($sunday->count() === 0 || $wednesday->count() === 0) {
            Mail::queue(new FailedToLocateLivestream(
                sunday: $this->nextSunday(),
                wednesday: $this->nextWednesday(),
                videos: $upcoming,
                tries: $this->attempts(),
            ));

            throw new \Exception('Could not find upcoming livestreams for Sunday and/or Wednesday.');
        }
    }

    /**
     * Calculate the number of seconds to wait before retrying the job.
     */
    public function backoff(): array
    {
        return [
            60 * 60 * 24, // Wait 24 hours before retrying. Ideally, this would be Saturday at 9am.
            60 * 60 * 8,  // Wait 8 hours after the next attempt, which is 32 hours after the first attempt. Ideally, this would be Saturday at 5pm.
            60 * 60 * 14, // Finally, we will check Sunday morning at 7 am, which is 46 hours after the first attempt.
        ];
    }

    /**
     * Retrieve the coming Sunday.
     */
    protected function nextSunday(): Carbon
    {
        if (today() === today()->startOfWeek()) {
            return today();
        }

        return today()->copy()->next(Carbon::SUNDAY);
    }

    /**
     * Retrieve the coming Wednesday.
     */
    protected function nextWednesday(): Carbon
    {
        if (today() === today()->startOfWeek()->addDays(3)) {
            return today();
        }

        return today()->copy()->next(Carbon::WEDNESDAY);
    }
}
