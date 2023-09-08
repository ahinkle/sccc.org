<?php

namespace App\Mail\Newsletter;

use App\Models\NewsletterContact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifiedNewsletterEmailAddress extends Mailable
{
    use Queueable,
        SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public NewsletterContact $newsletterContact,
    ) {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Newsletter Subscriber Request: '.$this->newsletterContact->email,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.newsletter.verified-newsletter-email-address',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
