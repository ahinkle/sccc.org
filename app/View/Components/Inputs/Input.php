<?php

namespace App\View\Components\Inputs;

use Ahinkle\AutoResolvableComponents\AutoResolvableComponent;

class Input extends AutoResolvableComponent
{
    public function __construct(
        public string $name,
        public ?string $type = 'text',
        public ?string $label = null,
        public bool $hideLabel = false,
        public ?string $placeholder = null,
        public ?string $wireModel = null,
        public ?string $wireModelBlur = null,
        public ?string $class = null,
    ) {
        $this->label ??= $this->guessLabel();
        $this->placeholder ??= $this->label;
    }

    /**
     * Guessing the input label by converting the name to a human readable format.
     */
    protected function guessLabel(): string
    {
        return ucfirst(preg_replace('/(?<!^)[A-Z]/', ' $0', $this->name));
    }
}
