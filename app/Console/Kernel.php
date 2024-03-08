<?php

namespace App\Console;

use App\Jobs\Events\PublishEventsFromFeedJob;
use App\Jobs\Livestream\PublishLivestreamAsMessageJob;
use App\Jobs\Livestream\UpdateUpcomingLivestreamJob;
use App\Jobs\NewsletterContacts\PruneUnverifiedNewsletterContactsJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('queue:prune-batches')->daily();
        $schedule->job(new PublishEventsFromFeedJob(today(), today()->addWeek()->endOfDay()))->hourly();
        $schedule->job(new PublishEventsFromFeedJob(today()->addDays(8), today()->addMonths(6)->endOfDay()))->everySixHours();
        $schedule->job(PruneUnverifiedNewsletterContactsJob::class)->daily();
        $schedule->job(UpdateUpcomingLivestreamJob::class)->weeklyOn(6, '9:00');
        $schedule->job(PublishLivestreamAsMessageJob::class)->weeklyOn(0, '11:00');
        $schedule->command('events:purge')->everySixHours();
        $schedule->command('events:verify')->everySixHours();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
    }
}
