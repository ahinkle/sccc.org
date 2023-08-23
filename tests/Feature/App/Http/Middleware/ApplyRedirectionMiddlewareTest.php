<?php

use App\Models\Redirect;

it('applies redirect', function () {
    $r = Redirect::factory()->permanent()->create();

    $this->get($r->from)
        ->assertRedirect($r->to, $r->code);
});
