<?php

namespace App\Jobs\NewsletterContacts;

use App\Models\NewsletterContact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PruneUnverifiedNewsletterContactsJob implements ShouldQueue
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
