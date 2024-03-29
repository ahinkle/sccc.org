<?php

namespace App\Jobs\Livestream;

use Alaouy\Youtube\Facades\Youtube;
use App\Mail\Livestream\FailedToLocateLivestream;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
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
            tap($this->notifyOnJobFailure(), fn () => throw new \Exception('No upcoming livestreams found.'));
        }

        $sunday = $this->firstLivestreamByDate($this->upcomingSunday(), $upcoming);
        $wednesday = $this->firstLivestreamByDate($this->upcomingWednesday(), $upcoming);

        if ($sunday->count() > 0) {
            cache()->put('livestream.sunday', $sunday->first()?->id?->videoId, now()->addWeek());
        }
        if ($wednesday->count() > 0) {
            cache()->put('livestream.wednesday', $wednesday->first()?->id?->videoId, now()->addWeek());
        }

        if ($sunday->count() === 0) {
            tap($this->notifyOnJobFailure($upcoming), fn () => throw new \Exception('Could not find upcoming livestreams for Sunday.'));
        }
    }

    /**
     * Retrieve the coming Sunday.
     */
    protected function upcomingSunday(): Carbon
    {
        return today()->format('D') === 'Sun' ? today() : today()->copy()->next(Carbon::SUNDAY);
    }

    /**
     * Retrieve the coming Wednesday.
     */
    protected function upcomingWednesday(): Carbon
    {
        return today()->format('D') === 'Wed' ? today() : today()->copy()->next(Carbon::WEDNESDAY);
    }

    /**
     * Locate the livestream by a provided Carbon date by the video title.
     */
    protected function firstLivestreamByDate(Carbon $date, Collection $videos)
    {
        return $videos->filter(
            fn ($item) => Str::contains($item->snippet?->title, $date->format('l, F j, Y'))
        );
    }

    /**
     * Notify via email that the job has failed.
     */
    private function notifyOnJobFailure(?Collection $videos = null): void
    {
        Mail::queue(
            new FailedToLocateLivestream(
                sunday: $this->upcomingSunday(),
                wednesday: $this->upcomingWednesday(),
                videos: $videos ?? collect(),
                tries: $this->attempts(),
            )
        );
    }
}
