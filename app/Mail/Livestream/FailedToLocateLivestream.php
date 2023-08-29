<?php

namespace App\Mail\Livestream;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class FailedToLocateLivestream extends Mailable
{
    use Queueable,
        SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Carbon $sunday,
        public Carbon $wednesday,
        public Collection $videos,
        public int $tries,
    ) {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Failed To Locate Livestream',
            to: [
                new Address('andy@sccc.org', 'Andy Hinkle'),
                new Address('tech@sccc.org', 'Stephen Rutherford'),
            ]
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.livestream.failed-to-locate-livestream',
            with: [
                'sunday' => $this->sunday,
                'wednesday' => $this->wednesday,
                'videos' => $this->videos,
                'attempt' => $this->humanReadableAttempts(),
            ]
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

    /**
     * The human readable format of attempts.
     */
    protected function humanReadableAttempts(): string
    {
        return match ($this->tries) {
            1 => 'another',
            2 => 'a 3rd',
            3 => 'a last',
            default => $this->tries,
        };
    }
}
