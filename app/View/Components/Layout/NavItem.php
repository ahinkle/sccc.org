<?php

namespace App\View\Components\Layout;

use Ahinkle\AutoResolvableComponents\AutoResolvableComponent;

class NavItem extends AutoResolvableComponent
{
    public function __construct(
        public string $href,
        public string $title,
        public bool $preventUnderline = false,
    ) {
        //
    }
}
