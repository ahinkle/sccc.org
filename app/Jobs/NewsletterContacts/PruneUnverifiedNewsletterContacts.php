<?php

namespace App\Jobs\NewsletterContacts;

use Illuminate\Bus\Queueable;
use App\Models\NewsletterContact;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class PruneUnverifiedNewsletterContacts implements ShouldQueue
{
    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        NewsletterContact::query()
            ->whereNull('email_verified_at')
            ->where('created_at', '<', now()->subDay())
            ->delete();
    }
}
