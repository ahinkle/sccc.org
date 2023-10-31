<?php

namespace App\Jobs\Events;

use App\Support\Elexio\ElexioFacade as Elexio;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Str;

class PublishEventsFromFeedJob implements ShouldQueue
{
    use Batchable,
        Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Carbon $start,
        public Carbon $end,
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $events = Elexio::events($this->start, $this->end);
        $id = Str::uuid();

        $jobs = collect($events)->map(
            fn (array $event) => new PublishEventFromFeedResponseJob($event, $id),
        );

        Bus::batch($jobs)->dispatch();
    }
}
