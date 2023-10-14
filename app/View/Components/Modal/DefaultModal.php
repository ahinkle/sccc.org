<?php

namespace App\View\Components\Modal;

use Ahinkle\AutoResolvableComponents\AutoResolvableComponent;

class DefaultModal extends AutoResolvableComponent
{
    public function __construct(
        public bool $show = false,
    ) {
        $cookie = 'modal-tabbernacle-sunday';
        $this->show = ! request()->hasCookie($cookie);

        if ($this->show) {
            cookie()->queue($cookie, 'true', 60 * 24);
        }
    }
}
