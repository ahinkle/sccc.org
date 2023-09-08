<?php

use App\Mail\Newsletter\VerifiedNewsletterEmailAddress;
use App\Mail\Newsletter\VerifyNewsletterEmailAddress;
use App\Models\NewsletterContact;
use Illuminate\Support\Facades\Mail;

it('generates token on creation', function () {
    $n = NewsletterContact::factory()->create();

    expect($n->token)->not->toBeNull();
});

it('sends verification email on creation', function () {
    Mail::fake();

    $n = NewsletterContact::factory()->create();

    Mail::assertQueued(VerifyNewsletterEmailAddress::class,
        fn ($mail) => $mail->hasTo($n->email)
    );
});

it('sends office notification on verified address', function () {
    Mail::fake();

    $n = NewsletterContact::factory()->create();

    Mail::assertNotQueued(VerifiedNewsletterEmailAddress::class);

    $n->update(['email_verified_at' => now()]);

    Mail::assertQueued(VerifiedNewsletterEmailAddress::class,
        fn ($mail) => $mail->hasTo('office@sccc.org')
    );
});

it('does not notify office on already verified email if timestamp is same', function () {
    Mail::fake();

    $n = NewsletterContact::factory()->verified()->create();

    Mail::assertNotQueued(VerifiedNewsletterEmailAddress::class);

    $n->update(['email_verified_at' => $n->email_verified_at]);

    Mail::assertNotQueued(VerifiedNewsletterEmailAddress::class);
});
