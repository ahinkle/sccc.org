<?php

namespace App\Jobs\Events;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class VerifyEventsExistenceJob implements ShouldQueue
{
    use Dispatchable,
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
        $events = Event::select('elexio_id')
            ->where('starts_at', '>=', $this->start)
            ->where('ends_at', '<=', $this->end)
            ->get();

        $events->each(fn (Event $event) => VerifyEventExistenceJob::dispatch($event->elexio_id));
    }
}
