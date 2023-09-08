<?php

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
