<?php

namespace App\View\Components\Inputs\Concerns;

trait InputLabelGuesser
{
    /**
     * Guessing the input label by converting the name to a human readable format.
     */
    protected function guessLabel(): string
    {
        if (! isset($this->name)) {
            throw new \Exception('The name property must be set to guess the label.');
        }

        return ucfirst(preg_replace('/(?<!^)[A-Z]/', ' $0', $this->name));
    }
}
