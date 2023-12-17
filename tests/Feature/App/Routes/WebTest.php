<?php

test('it renders homepage', function () {
    $this->get('/')
        ->assertOk()
        ->assertViewIs('pages.home')
        ->assertSee('Santa Claus Christian Church');
});

test('it redirects about to what we believe', function () {
    $this->get('/about')
        ->assertOk()
        ->assertViewIs('pages.about.what-we-believe');
});

test('it renders what we believe', function () {
    $this->get('/about/what-we-believe')
        ->assertOk()
        ->assertViewIs('pages.about.what-we-believe');
});

test('it renders staff', function () {
    $this->get('/about/staff')
        ->assertOk()
        ->assertViewIs('pages.about.staff');
});

test('it renders contact us', function () {
    $this->get('/contact-us')
        ->assertOk()
        ->assertViewIs('pages.contact-us');
});
