<?php

test('it renders homepage', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('Santa Claus Christian Church');
});
