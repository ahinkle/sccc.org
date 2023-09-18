<?php

namespace App\View\Components\Inputs;

use Ahinkle\AutoResolvableComponents\AutoResolvableComponent;

class Label extends AutoResolvableComponent
{
    public function __construct(
        public string $for,
        public bool $hideLabel = false,
    ) {
        //
    }
}
