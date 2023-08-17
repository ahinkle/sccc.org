<?php

namespace App\View\Components\Inputs;

use Ahinkle\AutoResolvableComponents\AutoResolvableComponent;

class Button extends AutoResolvableComponent
{
    public function __construct(
        public ?string $href,
    ) {
        //
    }
}
