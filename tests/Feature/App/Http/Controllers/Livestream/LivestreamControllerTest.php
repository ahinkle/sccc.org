<?php

use Illuminate\Support\Carbon;

use function Pest\Laravel\travelTo;

it('redirects index to active livestream for sunday', function () {
    travelTo(Carbon::parse('last sunday'));

    $this->get(route('livestream.index'))
        ->assertRedirect(route('livestream.show', 'sunday'));
});

it('redirects index to active livestream for wednesday', function () {
    travelTo(Carbon::parse('last wednesday'));

    $this->get(route('livestream.index'))
        ->assertRedirect(route('livestream.show', 'wednesday'));
});

it('redirects index to active livestream to sunday when any other day', function () {
    travelTo(Carbon::parse('last monday'));

    $this->get(route('livestream.index'))
        ->assertRedirect(route('livestream.show', 'sunday'));
});

it('redirects sunday show method to youtube', function () {
    travelTo(Carbon::parse('last sunday'));
    cache()->put('livestream.sunday', '1234567890');
    cache()->put('livestream.wednesday', 'fake-video-id-that-we-should-not-use');

    $this->get(route('livestream.show', 'sunday'))
        ->assertRedirect('https://youtu.be/1234567890');
});

it('redirects wednesday show method to youtube', function () {
    travelTo(Carbon::parse('last wednesday'));
    cache()->put('livestream.sunday', 'fake-video-id-that-we-should-not-use');
    cache()->put('livestream.wednesday', '1234567890');

    $this->get(route('livestream.show', 'wednesday'))
        ->assertRedirect('https://youtu.be/1234567890');
});

it('redirects unknown day or unknown stream to youtube channel streams page', function () {
    $this->get(route('livestream.show', 'foo'))
        ->assertRedirect('https://youtu.be/@SantaClausChristianChurch');

    $this->get(route('livestream.show', 'monday'))
        ->assertRedirect('https://youtu.be/@SantaClausChristianChurch');

    $this->get(route('livestream.show', 'sunday'))
        ->assertRedirect('https://youtu.be/@SantaClausChristianChurch/streams');

    $this->get(route('livestream.show', 'wednesday'))
        ->assertRedirect('https://youtu.be/@SantaClausChristianChurch/streams');
});
