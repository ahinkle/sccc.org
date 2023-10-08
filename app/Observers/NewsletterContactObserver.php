<?php

namespace App\Observers;

use App\Mail\Newsletter\VerifiedNewsletterEmailAddress;
use App\Mail\Newsletter\VerifyNewsletterEmailAddress;
use App\Models\NewsletterContact;
use Illuminate\Support\Facades\Mail;

class NewsletterContactObserver
{
    /**
     * Handle the NewsletterContact "creating" event.
     */
    public function creating(NewsletterContact $newsletterContact): void
    {
        $newsletterContact->token = bin2hex(random_bytes(32));
    }

    /**
     * Handle the NewsletterContact "created" event.
     */
    public function created(NewsletterContact $newsletterContact): void
    {
        Mail::to($newsletterContact->email)
            ->queue(new VerifyNewsletterEmailAddress($newsletterContact));
    }

    /**
     * Handle the NewsletterContact "updated" event.
     */
    public function updated(NewsletterContact $newsletterContact): void
    {
        if ($newsletterContact->email_verified_at
            && $newsletterContact->wasChanged('email_verified_at')
        ) {
            Mail::to('office@sccc.org')
                ->queue(new VerifiedNewsletterEmailAddress($newsletterContact));
        }
    }
}
