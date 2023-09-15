<?php

namespace App\Console;

use App\Jobs\Events\PublishRecurringEvents;
use App\Jobs\NewsletterContacts\PruneUnverifiedNewsletterContacts;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->job(PublishRecurringEvents::class)->daily();
        $schedule->job(PruneUnverifiedNewsletterContacts::class)->daily();
        $schedule->job(UpdateUpcomingLivestreamJob::class)->weeklyOn(6, '9:00');
        $schedule->job(PublishLivestreamAsMessageJob::class)->weeklyOn(0, '11:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
