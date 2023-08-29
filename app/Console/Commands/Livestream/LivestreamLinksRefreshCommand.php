<?php

namespace App\Console\Commands\Livestream;

use App\Jobs\UpdateUpcomingLivestreamJob;
use Illuminate\Console\Command;

class LivestreamLinksRefreshCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'livestream:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh the upcoming livestream links from the YouTube API.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        UpdateUpcomingLivestreamJob::dispatch();

        $this->info('Fired job to refresh upcoming livestream links.');

        return 0;
    }
}
