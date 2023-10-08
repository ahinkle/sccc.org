<?php

namespace App\View\Components\Inputs;

use Ahinkle\AutoResolvableComponents\AutoResolvableComponent;
use App\View\Components\Inputs\Concerns\InputLabelGuesser;

class Input extends AutoResolvableComponent
{
    use InputLabelGuesser;

    public function __construct(
        public string $name,
        public ?string $type = 'text',
        public ?string $label = null,
        public bool $hideLabel = false,
        public ?string $placeholder = null,
        public ?string $class = null,
    ) {
        $this->label ??= $this->guessLabel();
        $this->placeholder ??= $this->label;
    }
}
