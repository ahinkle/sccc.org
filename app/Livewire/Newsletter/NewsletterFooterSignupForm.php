<?php

namespace App\Livewire\Newsletter;

use App\Models\NewsletterContact;
use Livewire\Attributes\Rule;
use Livewire\Component;

class NewsletterFooterSignupForm extends Component
{
    /**
     * The name of the newsletter subscriber.
     */
    #[Rule(['required', 'string', 'max:255'])]
    public ?string $name;

    /**
     * The email address of the newsletter subscriber.
     */
    #[Rule(['required', 'email', 'unique:newsletter_contacts,email,', 'max:255'],
        message: [
            'unique' => 'You are already subscribed to our newsletter.',
        ]
    )]
    public ?string $email;

    /**
     * Indicates if the newsletter subscriber needs to be verified.
     */
    public bool $showVerifyEmailMessage = false;

    /**
     * Subscribe the user to the newsletter.
     */
    public function subscribe(): void
    {
        $validated = $this->validate();

        NewsletterContact::create($validated);

        $this->showVerifyEmailMessage = true;
    }
}
