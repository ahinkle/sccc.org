<?php

use App\Livewire\Newsletter\NewsletterFooterSignupForm;
use App\Models\NewsletterContact;
use Livewire\Livewire;

it('signs up for newsletter', function () {
    Queue::fake();
    $n = NewsletterContact::factory()->make();

    Livewire::test(NewsletterFooterSignupForm::class)
        ->assertOk()
        ->assertDontSee('Please check your email')
        ->set('name', $n->name)
        ->set('email', $n->email)
        ->call('subscribe')
        ->assertSee('Please check your email');

    expect(NewsletterContact::count())->toBe(1);
});

it('requires fields', function () {
    Livewire::test(NewsletterFooterSignupForm::class)
        ->assertOk()
        ->assertDontSee('Please check your email')
        ->set('name', '')
        ->set('email', '')
        ->call('subscribe')
        ->assertHasErrors();

    expect(NewsletterContact::count())->toBe(0);
});

it('prevents duplicates', function () {
    Queue::fake();
    $n = NewsletterContact::factory()->create();

    Livewire::test(NewsletterFooterSignupForm::class)
        ->assertOk()
        ->assertDontSee('Please check your email')
        ->set('name', $n->name)
        ->set('email', $n->email)
        ->call('subscribe')
        ->assertHasErrors();

    expect(NewsletterContact::count())->toBe(1);
});
