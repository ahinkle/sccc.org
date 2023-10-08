<?php

namespace App\View\Components\Hero;

use Ahinkle\AutoResolvableComponents\AutoResolvableComponent;

class PageHero extends AutoResolvableComponent
{
    public function __construct(
        public ?string $bgUrl = null,
    ) {
        //
    }
}
