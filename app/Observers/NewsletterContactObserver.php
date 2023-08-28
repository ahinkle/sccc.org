<?php

namespace App\Observers;

use App\Models\NewsletterContact;

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
        //
    }
}
