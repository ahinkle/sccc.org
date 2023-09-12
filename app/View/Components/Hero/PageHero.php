<?php

namespace App\View\Components\Hero;

use Ahinkle\AutoResolvableComponents\AutoResolvableComponent;

class PageHero extends AutoResolvableComponent
{
    public function __construct(
        public string $bgUrl = 'https://via.placeholder.com/1200x600',
    ) {
        //
    }
}
