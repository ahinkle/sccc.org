<?php

use App\Models\NewsletterContact;

it('will verify the newsletter email address', function () {
    $newsletterContact = NewsletterContact::factory()->create();

    $this
        ->get(route('newsletter.verify', [
            'email' => $newsletterContact->email,
            'token' => $newsletterContact->token,
        ]))
        ->assertRedirect('/');

    $this->assertNotNull($newsletterContact->fresh()->email_verified_at);
});

it('doesnt verify invalid token but correct email', function () {
    $newsletterContact = NewsletterContact::factory()->create();

    $this
        ->get(route('newsletter.verify', [
            'email' => $newsletterContact->email,
            'token' => 'invalid-token',
        ]))
        ->assertNotFound();

    $this->assertNull($newsletterContact->fresh()->email_verified_at);
});

it('doesnt verify invalid email but correct token', function () {
    $newsletterContact = NewsletterContact::factory()->create();

    $this
        ->get(route('newsletter.verify', [
            'email' => 'foo@bar.com',
            'token' => $newsletterContact->token,
        ]))
        ->assertNotFound();

    $this->assertNull($newsletterContact->fresh()->email_verified_at);
});

it('doesnt reverify', function () {
    $newsletterContact = NewsletterContact::factory()->create([
        'email_verified_at' => '2020-01-01 00:00:00',
    ]);

    $this
        ->get(route('newsletter.verify', [
            'email' => $newsletterContact->email,
            'token' => $newsletterContact->token,
        ]))
        ->assertRedirect('/');

    $this->assertEquals('2020-01-01 00:00:00', $newsletterContact->fresh()->email_verified_at);
});

it('throttles newsletter verification requests', function () {
    $this->get(route('newsletter.verify'))->assertNotFound();
    $this->get(route('newsletter.verify'))->assertNotFound();
    $this->get(route('newsletter.verify'))->assertNotFound();
    $this->get(route('newsletter.verify'))->assertNotFound();
    $this->get(route('newsletter.verify'))->assertNotFound();
    $this->get(route('newsletter.verify'))->assertTooManyRequests();
});
