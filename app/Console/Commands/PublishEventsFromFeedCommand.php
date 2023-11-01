<?php

namespace App\Console\Commands;

use App\Jobs\Events\PublishEventsFromFeedJob;
use Illuminate\Console\Command;

class PublishEventsFromFeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish events from the Elexio feed';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        dispatch(new PublishEventsFromFeedJob(today(), today()->addMonths(6)->endOfDay()));

        return 0;
    }
}
