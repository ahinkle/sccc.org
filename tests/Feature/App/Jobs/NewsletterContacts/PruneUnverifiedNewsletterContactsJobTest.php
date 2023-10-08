<?php

use App\Jobs\NewsletterContacts\PruneUnverifiedNewsletterContactsJob;
use App\Models\NewsletterContact;

it('removes unverified newsletter contacts', function () {
    $verified = NewsletterContact::factory()->verified()->create();
    $pending = NewsletterContact::factory()->pending()->create();
    $unverified = NewsletterContact::factory()->unverified()->create();

    PruneUnverifiedNewsletterContactsJob::dispatch();
    expect(NewsletterContact::count())->toBe(2);

    expect($verified->fresh())->not()->toBe(null);
    expect($pending->fresh())->not()->toBe(null);
    expect($unverified->fresh())->toBe(null);
});
