<?php

namespace App\Console\Commands\Events;

use App\Jobs\Events\PublishRecurringEventsJob;
use Illuminate\Console\Command;

class PublishRecurringEventsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:recurring {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish recurring events from the prior day.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->option('force') || $this->confirm('This will launch a background task to publish recurring events from the prior day. Are you sure you want to continue?', true)) {
            $this->info('Publishing recurring events from the prior day...');
            dispatch(new PublishRecurringEventsJob());
            $this->info('Successfully launched task.');
        }
    }
}
